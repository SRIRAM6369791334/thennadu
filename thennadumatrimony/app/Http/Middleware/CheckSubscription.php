<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPackage;
use Carbon\Carbon;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $feature
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $feature = null)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $activePackage = UserPackage::where('user_varan_id', $user->varan_id)
            ->where('status', 1)
            ->where('validity_date', '>', Carbon::now())
            ->first();

        if (!$activePackage) {
            return redirect()->route('plans.index')->with('warning', 'Please subscribe to a plan to access this feature.');
        }

        if ($feature) {
            switch ($feature) {
                case 'chat':
                    if (strtolower($activePackage->enable_chat) !== 'yes') {
                        return redirect()->route('plans.index')->with('warning', 'Your current plan does not support direct chat. Upgrade now!');
                    }
                    break;
                case 'call':
                    if (strtolower($activePackage->enable_call) !== 'yes') {
                        return redirect()->route('plans.index')->with('warning', 'Your current plan does not support voice/video calls. Upgrade now!');
                    }
                    break;
                case 'advanced_search':
                    if (strtolower($activePackage->enable_advancesearch) !== 'yes') {
                        return redirect()->route('plans.index')->with('warning', 'Your current plan does not support advanced search. Upgrade now!');
                    }
                    break;
            }
        }

        // Shared package data across the request for easy access in views or controllers
        view()->share('activePackage', $activePackage);

        return $next($request);
    }
}
