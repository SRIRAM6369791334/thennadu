<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MatchmakingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MatchController extends Controller
{
    protected $matchService;

    public function __construct(MatchmakingService $matchService)
    {
        $this->matchService = $matchService;
    }

    /**
     * Show prospective matches for the logged-in user.
     */
    public function index(Request $request)
    {
        $sessionUser = Auth::user();
        
        if (!$sessionUser) {
            return redirect()->route('login')->with('error', 'Please log in to view matches.');
        }

        // The session user might be App\Models\Profile, but our matchmaking uses App\Models\User.
        // We'll search for the corresponding User model by email.
        $user = \App\Models\User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Your profile is not yet fully migrated to the new matchmaking system.');
        }

        $options = [
            'include_horoscope' => $request->get('include_horoscope', '0') == '1',
            'intensity'         => $request->get('intensity', 50),
            'has_photos'        => $request->has('has_photos'),
            'is_verified'       => $request->has('is_verified'),
            'gender'            => $request->get('gender'),
            'min_age'           => $request->get('min_age'),
            'max_age'           => $request->get('max_age'),
            'religion'          => $request->get('religion'),
            'show_all'          => $request->get('show_all', '0') == '1',
        ];

        // Fetch matches using MatchmakingService
        $matches = $this->matchService->getPotentialMatches($user, $options);

        // Manual Pagination for the Collection
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = $matches->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $paginatedMatches = new LengthAwarePaginator(
            $currentItems, 
            $matches->count(), 
            $perPage, 
            $currentPage, 
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Fetch interests sent by user to handle UI status
        $sentInterests = \App\Models\InterestRequest::where('sender_id', $user->id)->pluck('status', 'receiver_id');

        return view('pages.matches', [
            'user' => $user,
            'matches' => $paginatedMatches,
            'sentInterests' => $sentInterests
        ]);
    }
}
