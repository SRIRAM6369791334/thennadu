<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterestRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterestManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = InterestRequest::with(['sender', 'receiver']);

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('sender', function($sq) use ($search) {
                    $sq->where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%")->orWhere('user_ID', 'LIKE', "%$search%");
                })->orWhereHas('receiver', function($sq) use ($search) {
                    $sq->where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%")->orWhere('user_ID', 'LIKE', "%$search%");
                });
            });
        }

        $interests = $query->latest()->paginate(15);

        // Analytics
        $total = InterestRequest::count();
        $stats = [
            'total' => $total,
            'accepted_pc' => $total > 0 ? round((InterestRequest::where('status', 1)->count() / $total) * 100, 1) : 0,
            'rejected_pc' => $total > 0 ? round((InterestRequest::where('status', 2)->count() / $total) * 100, 1) : 0,
            'pending' => InterestRequest::where('status', 0)->count(),
        ];

        return view('admin.interests.index', compact('interests', 'stats'));
    }

    public function accept($id)
    {
        $request = InterestRequest::findOrFail($id);
        $request->update(['status' => 1]);
        return back()->with('success', 'Interest request forced to Accept.');
    }

    public function reject($id)
    {
        $request = InterestRequest::findOrFail($id);
        $request->update(['status' => 2]);
        return back()->with('success', 'Interest request forced to Reject.');
    }

    public function destroy($id)
    {
        $request = InterestRequest::findOrFail($id);
        $request->delete();
        return back()->with('success', 'Interest request deleted successfully.');
    }

    /**
     * Fetch complete sender/receiver profile details for admin preview.
     */
    public function showProfile($id, $type = 'sender')
    {
        $interest = InterestRequest::findOrFail($id);
        $userId = ($type == 'sender') ? $interest->sender_id : $interest->receiver_id;

        $user = User::with([
            'userDetail', 
            'educationJob', 
            'address', 
            'familyDetail', 
            'horoscopeDetail'
        ])->find($userId);

        if (!$user) {
            return response()->json(['error' => 'User profile not found in normalized tables.'], 404);
        }

        return response()->json([
            'user' => $user,
            'type' => ucfirst($type),
            'varan_id' => $user->user_ID
        ]);
    }
}
