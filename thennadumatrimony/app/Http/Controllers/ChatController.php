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

        // Map to User model
        $user = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        if (!$user) return redirect()->route('dashboard');

        $conversations = Conversation::where('user_one', $user->id)
            ->orWhere('user_two', $user->id)
            ->with(['userOne', 'userTwo', 'lastMessage'])
            ->get();

        return view('pages.chat.index', compact('conversations', 'user'));
    }

    public function startConversation($userId)
    {
        $sessionUser = Auth::user();
        if (!$sessionUser) return redirect()->route('login');

        // Map the current session user to User model
        $currentUserModel = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        if (!$currentUserModel) return back()->with('error', 'Your user account is not synchronized.');
        $currentUser = $currentUserModel->id;

        // The targetUserId is already the User ID or we search by Profile ID
        $targetUser = User::find($userId);
        if (!$targetUser) {
            // Fallback: Check if it's a Profile ID
            $targetProfile = \App\Models\Profile::find($userId);
            if ($targetProfile) {
                $targetUser = User::where('email', $targetProfile->email_id)->first();
            }
        }

        if (!$targetUser) return back()->with('error', 'Target user account not found.');
        $targetUserId = $targetUser->id;

        // Step 2: Conversation Logic - Check interest status = accepted (mutual)
        $interest = InterestRequest::where(function($query) use ($currentUser, $targetUserId) {
            $query->where('sender_id', $currentUser)->where('receiver_id', $targetUserId);
        })->orWhere(function($query) use ($currentUser, $targetUserId) {
            $query->where('sender_id', $targetUserId)->where('receiver_id', $currentUser);
        })->where('status', 1)->first();

        if (!$interest) {
            return back()->with('error', 'You can only chat after interest is accepted.');
        }

        // Check if conversation exists
        $conversation = Conversation::where(function($query) use ($currentUser, $targetUserId) {
            $query->where('user_one', $currentUser)->where('user_two', $targetUserId);
        })->orWhere(function($query) use ($currentUser, $targetUserId) {
            $query->where('user_one', $targetUserId)->where('user_two', $currentUser);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one' => $currentUser,
                'user_two' => $targetUserId
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

        $conversation = Conversation::with(['userOne', 'userTwo'])->findOrFail($conversationId);

        // Security: Validate conversation ownership
        if ($conversation->user_one !== $user->id && $conversation->user_two !== $user->id) {
            abort(403);
        }

        $conversations = Conversation::where('user_one', $user->id)
            ->orWhere('user_two', $user->id)
            ->with(['userOne', 'userTwo', 'lastMessage'])
            ->get();

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

        $conversation = Conversation::findOrFail($request->conversation_id);

        if ($conversation->user_one !== $user->id && $conversation->user_two !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Step 6: Abuse filter (simple example)
        $abusiveWords = ['spam', 'abuse', 'offensive']; // Placeholder
        $filteredMessage = str_ireplace($abusiveWords, '***', $request->message);
        
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'message' => $filteredMessage,
            'is_read' => false
        ]);

        // Broadcast the event with a try/catch in case Reverb is down
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

        $conversation = Conversation::findOrFail($conversationId);

        if ($conversation->user_one !== $user->id && $conversation->user_two !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = Message::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();
            
        return response()->json($messages);
    }
}
