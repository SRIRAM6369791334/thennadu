<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Models\ChatSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatManagementController extends Controller
{
    /**
     * View all conversations.
     */
    public function index(Request $request)
    {
        $query = Conversation::with(['userOne', 'userTwo', 'lastMessage']);

        // Filter by user
        if ($request->has('user_id') && $request->user_id) {
            $query->where(function($q) use ($request) {
                $q->where('user_one', $request->user_id)
                  ->orWhere('user_two', $request->user_id);
            });
        }

        // Filter by date
        if ($request->has('date') && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter by flagged messages
        if ($request->has('flagged') && $request->flagged == '1') {
            $query->whereHas('messages', function($q) {
                $q->where('flagged_by_admin', true);
            });
        }

        $conversations = $query->latest('updated_at')->paginate(20);
        $users = User::select('id', 'name')->get();

        return view('admin.chat.index', compact('conversations', 'users'));
    }

    /**
     * View full chat history for a conversation.
     */
    public function show($id)
    {
        $conversation = Conversation::with(['userOne', 'userTwo', 'messages.sender'])->findOrFail($id);
        
        return view('admin.chat.show', compact('conversation'));
    }

    /**
     * Delete a conversation.
     */
    public function destroy($id)
    {
        $conversation = Conversation::findOrFail($id);
        $conversation->delete();

        return redirect()->route('admin.chat.index')->with('success', 'Conversation deleted successfully.');
    }

    /**
     * Block a user from chatting.
     */
    public function blockUser($userId)
    {
        $setting = ChatSetting::firstOrCreate(['user_id' => $userId]);
        $setting->update(['is_blocked' => true]);

        return back()->with('success', 'User has been blocked from chatting.');
    }

    /**
     * Flag or unflag a message as abusive.
     */
    public function flagMessage(Request $request, $messageId)
    {
        $message = Message::findOrFail($messageId);
        $message->update([
            'flagged_by_admin' => $request->flagged == '1',
            'is_abusive' => $request->flagged == '1'
        ]);

        return response()->json(['status' => 'success']);
    }
}
