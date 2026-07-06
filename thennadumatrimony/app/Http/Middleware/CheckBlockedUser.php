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
            $user = Auth::user();

            if ($user->blockstatus == 1) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/register')
                    ->withErrors([
                        'login_id' => 'உங்கள் கணக்கு தற்காலிகமாக முடக்கப்பட்டுள்ளது. மேலும் விவரங்களுக்கு எங்கள் வாடிக்கையாளர் சேவையைத் தொடர்பு கொள்ளவும். (Your account has been temporarily blocked. Please contact our customer support.)',
                    ])
                    ->withInput();
            }

            if ($user->status == 2) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/register')
                    ->withErrors([
                        'login_id' => 'உங்கள் கணக்கு நிராகரிக்கப்பட்டுள்ளது. மேலும் விவரங்களுக்கு எங்கள் வாடிக்கையாளர் சேவையைத் தொடர்பு கொள்ளவும். (Your account has been rejected. Please contact our customer support.)',
                    ])
                    ->withInput();
            }
        }

        return $next($request);
    }
}
