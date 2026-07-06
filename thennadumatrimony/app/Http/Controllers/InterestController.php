<?php

namespace App\Http\Controllers;

use App\Models\InterestRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterestController extends Controller
{
    /**
     * Send interest to another user.
     */
    public function sendInterest($receiverId)
    {
        $sessionUser = Auth::user();
        
        // Find the User model corresponding to the logged-in Profile
        $user = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();

        if (!$user) {
            return back()->with('error', 'Your account is not fully synchronized.');
        }

        $senderId = $user->id;

        // Prevent self-interest
        if ($senderId == $receiverId) {
            return back()->with('error', 'You cannot send interest to yourself.');
        }

        // Check if receiver exists
        if (!User::find($receiverId)) {
            return back()->with('error', 'User not found.');
        }

        // Check for existing interest
        $existing = InterestRequest::where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->first();

        if ($existing) {
            return back()->with('info', 'Interest already sent.');
        }

        InterestRequest::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 0 // Pending
        ]);

        return back()->with('success', 'Interest sent successfully!');
    }

    /**
     * Cancel a pending interest.
     */
    public function cancelInterest($receiverId)
    {
        $sessionUser = Auth::user();
        $user = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        
        if (!$user) return back();

        InterestRequest::where('sender_id', $user->id)
            ->where('receiver_id', $receiverId)
            ->where('status', 0)
            ->delete();

        return back()->with('success', 'Interest request cancelled.');
    }

    /**
     * Accept a received interest.
     */
    public function acceptInterest($id)
    {
        $sessionUser = Auth::user();
        $user = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        
        if (!$user) return back();

        $interest = InterestRequest::where('id', $id)
            ->where('receiver_id', $user->id)
            ->firstOrFail();

        $interest->update(['status' => 1]); // Accepted

        return back()->with('success', 'Interest accepted! You can now chat.');
    }

    /**
     * Reject a received interest.
     */
    public function rejectInterest($id)
    {
        $sessionUser = Auth::user();
        $user = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
        
        if (!$user) return back();

        $interest = InterestRequest::where('id', $id)
            ->where('receiver_id', $user->id)
            ->firstOrFail();

        $interest->update(['status' => 2]); // Rejected

        return back()->with('success', 'Interest declined.');
    }

    /**
     * View sent and received interests.
     */
    public function index()
    {
        $sessionUser = Auth::user();
        $user = User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();

        // Fetch images for sidebar compatibility
        $images = \Illuminate\Support\Facades\DB::table('images')->where('varanid', $sessionUser->varan_id)->get();

        if (!$user) {
            return view('pages.interests', [
                'sentRequests' => collect(), 
                'receivedRequests' => collect(),
                'images' => $images
            ]);
        }

        $sentRequests = InterestRequest::where('sender_id', $user->id)->with('receiver.userDetail')->latest()->get();
        $receivedRequests = InterestRequest::where('receiver_id', $user->id)->with('sender.userDetail')->latest()->get();

        return view('pages.interests', compact('sentRequests', 'receivedRequests', 'images'));
    }
}
