<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBlockedUser
{
    /**
     * Handle an incoming request.
     * If the logged-in user's account is blocked (blockstatus=1)
     * or rejected (status=2), log them out immediately and
     * redirect to login with an error message.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Force fresh read from database to get latest status
            $user = \App\Models\Profile::find(Auth::id());

            if (!$user) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/register');
            }

            if ($user->blockstatus == 1) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/register')
                    ->withErrors([
                        'login_id' => ' Your account has been temporarily blocked. Please contact our customer support.',
                    ])
                    ->withInput();
            }

            if ($user->status == 2) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/register')
                    ->withErrors([
                        'login_id' => 'Your account has been rejected. Please contact our customer support.',
                    ])
                    ->withInput();
            }

            if ($user->status == 0) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/register')
                    ->withErrors([
                        'login_id' => 'Your account has been deleted. Please contact our customer support.',
                    ])
                    ->withInput();
            }
        }

        return $next($request);
    }
}
