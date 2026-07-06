<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\InterestRequest;
use App\Models\User;
use App\Models\ChatSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $setting = ChatSetting::where('user_id', $user->id)->first();
        if ($setting && $setting->is_blocked) {
            return back()->with('error', 'Your chat access has been blocked by admin.');
        }

        $conversations = Conversation::where('user_one', $user->id)
            ->orWhere('user_two', $user->id)
            ->with(['userOne', 'userTwo', 'lastMessage'])
            ->get();

        return view('pages.chat.index', compact('conversations'));
    }

    public function startConversation($userId)
    {
        $currentUser = Auth::id();
        if (!$currentUser) return redirect()->route('login');

        // Step 2: Conversation Logic - Check interest status = accepted (mutual)
        $interest = InterestRequest::where(function($query) use ($currentUser, $userId) {
            $query->where('sender_id', $currentUser)->where('receiver_id', $userId);
        })->orWhere(function($query) use ($currentUser, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $currentUser);
        })->where('status', 1)->first();

        if (!$interest) {
            return back()->with('error', 'You can only chat after interest is accepted.');
        }

        // Check if conversation exists
        $conversation = Conversation::where(function($query) use ($currentUser, $userId) {
            $query->where('user_one', $currentUser)->where('user_two', $userId);
        })->orWhere(function($query) use ($currentUser, $userId) {
            $query->where('user_one', $userId)->where('user_two', $currentUser);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one' => $currentUser,
                'user_two' => $userId
            ]);
        }

        return redirect()->route('chat.show', $conversation->id);
    }

    public function show($conversationId)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $setting = ChatSetting::where('user_id', $user->id)->first();
        if ($setting && $setting->is_blocked) {
            return back()->with('error', 'Your chat access has been blocked by admin.');
        }

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

        return view('pages.chat.index', compact('conversations', 'conversation', 'messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string|max:1000'
        ]);

        $user = Auth::user();
        $conversation = Conversation::findOrFail($request->conversation_id);

        if ($conversation->user_one !== $user->id && $conversation->user_two !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Security: Check if user is blocked by admin
        $setting = ChatSetting::where('user_id', $user->id)->first();
        if ($setting && $setting->is_blocked) {
            return response()->json(['error' => 'Your chat access is blocked by admin.'], 403);
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

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'html' => view('pages.chat.partials.message', ['message' => $message])->render()
            ]);
        }

        return back();
    }

    public function getMessages($conversationId)
    {
        $user = Auth::id();
        $conversation = Conversation::findOrFail($conversationId);

        if ($conversation->user_one !== $user && $conversation->user_two !== $user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = Message::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();
            
        return response()->json($messages);
    }
}
