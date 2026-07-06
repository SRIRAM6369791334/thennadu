<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\InterestRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $sessionUser = Auth::user();
        if (!$sessionUser) return redirect()->route('login');

        $user = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        if (!$user) return redirect()->route('dashboard');

        $conversations = Conversation::where('user_one', $user->id)
            ->orWhere('user_two', $user->id)
            ->with(['userOne', 'userTwo', 'lastMessage'])
            ->get()
            ->filter(function ($conv) {
                // Skip conversations where the other user was deleted
                $otherUser = $conv->user_one == Auth::id() ? $conv->userTwo : $conv->userOne;
                return $otherUser !== null;
            });

        return view('pages.chat.index', compact('conversations', 'user'));
    }

    public function startConversation($userId)
    {
        $sessionUser = Auth::user();
        if (!$sessionUser) return redirect()->route('login');

        $currentUserModel = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        if (!$currentUserModel) return back()->with('error', 'Your user account is not synchronized.');
        $currentUser = $currentUserModel->id;

        // Check if target user exists
        $targetUser = User::find($userId);
        if (!$targetUser) {
            return back()->with('error', 'This user no longer exists or has been deleted.');
        }

        // Check if target user account is active
        $targetProfile = \App\Models\Profile::where('id', $userId)->orWhere('varan_id', $targetUser->user_ID ?? '')->first();
        if ($targetProfile && $targetProfile->status == 0) {
            return back()->with('error', 'This user account has been deleted.');
        }

        // Check interest status = accepted (mutual)
        $interest = InterestRequest::where(function($query) use ($currentUser, $targetUser) {
            $query->where('sender_id', $currentUser)->where('receiver_id', $targetUser->id);
        })->orWhere(function($query) use ($currentUser, $targetUser) {
            $query->where('sender_id', $targetUser->id)->where('receiver_id', $currentUser);
        })->where('status', 1)->first();

        if (!$interest) {
            return back()->with('error', 'You can only chat after interest is accepted.');
        }

        // Check if conversation exists
        $conversation = Conversation::where(function($query) use ($currentUser, $targetUser) {
            $query->where('user_one', $currentUser)->where('user_two', $targetUser->id);
        })->orWhere(function($query) use ($currentUser, $targetUser) {
            $query->where('user_one', $targetUser->id)->where('user_two', $currentUser);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one' => $currentUser,
                'user_two' => $targetUser->id
            ]);
        }

        return redirect()->route('chat.show', $conversation->id);
    }

    public function show($conversationId)
    {
        $sessionUser = Auth::user();
        if (!$sessionUser) return redirect()->route('login');

        $user = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        if (!$user) return redirect()->route('dashboard');

        $conversation = Conversation::with(['userOne', 'userTwo'])->find($conversationId);

        if (!$conversation) {
            return redirect()->route('chat.index')->with('error', 'This conversation no longer exists.');
        }

        // Check if the other user was deleted
        $otherUser = $conversation->user_one == $user->id ? $conversation->userTwo : $conversation->userOne;
        if (!$otherUser) {
            return redirect()->route('chat.index')->with('error', 'This user has been removed.');
        }

        // Security: Validate conversation ownership
        if ($conversation->user_one !== $user->id && $conversation->user_two !== $user->id) {
            abort(403);
        }

        $conversations = Conversation::where('user_one', $user->id)
            ->orWhere('user_two', $user->id)
            ->with(['userOne', 'userTwo', 'lastMessage'])
            ->get()
            ->filter(function ($conv) {
                $other = $conv->user_one == Auth::id() ? $conv->userTwo : $conv->userOne;
                return $other !== null;
            });

        $messages = Message::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark as read
        Message::where('conversation_id', $conversationId)
            ->where('sender_id', '!=', $user->id)
            ->update(['is_read' => true]);

        return view('pages.chat.index', compact('conversations', 'conversation', 'messages', 'user'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string|max:1000'
        ]);

        $sessionUser = Auth::user();
        $user = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        if (!$user) return response()->json(['error' => 'Unauthorized'], 401);

        $conversation = Conversation::find($request->conversation_id);

        if (!$conversation) {
            return response()->json(['error' => 'Conversation not found.'], 404);
        }

        // Check if other user still exists
        $otherUserId = $conversation->user_one == $user->id ? $conversation->user_two : $conversation->user_one;
        $otherUser = User::find($otherUserId);
        if (!$otherUser) {
            return response()->json(['error' => 'This user has been removed.'], 404);
        }

        if ($conversation->user_one !== $user->id && $conversation->user_two !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $abusiveWords = ['spam', 'abuse', 'offensive'];
        $filteredMessage = str_ireplace($abusiveWords, '***', $request->message);
        
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'message' => $filteredMessage,
            'is_read' => false
        ]);

        try {
            broadcast(new \App\Events\MessageSent($message, $conversation->id))->toOthers();
        } catch (\Exception $e) {
            \Log::error('Broadcast failed: ' . $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'id' => $message->id,
                'html' => view('pages.chat.partials.message', ['message' => $message, 'user' => $user])->render()
            ]);
        }

        return back();
    }

    public function getMessages($conversationId)
    {
        $sessionUser = Auth::user();
        $user = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        if (!$user) return response()->json(['error' => 'Unauthorized'], 401);

        $conversation = Conversation::find($conversationId);

        if (!$conversation) {
            return response()->json(['error' => 'Conversation not found.'], 404);
        }

        if ($conversation->user_one !== $user->id && $conversation->user_two !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = Message::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();
            
        return response()->json($messages);
    }
}
