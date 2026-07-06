<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        // Require a login identifier and a password
        $request->validate([
            'login_id' => 'required',
            'password' => 'required',
        ]);

        $loginId = $request->login_id;

        // Find the user by email_id OR mobile_no
        $user = Profile::where('email_id', $loginId)
                       ->orWhere('mobile_no', $loginId)
                       ->first();

        if (!$user) {
            return back()->withErrors([
                'login_id' => 'No account found with this email address or mobile number.',
            ])->onlyInput('login_id');
        }

        $inputPassword = $request->password;
        $storedPassword = $user->password;
        $authenticated = false;

        // Check if stored password is bcrypt hashed
        if (Hash::needsRehash($storedPassword) === false && Hash::check($inputPassword, $storedPassword)) {
            // Password is already hashed and matches
            $authenticated = true;
        } elseif (!str_starts_with($storedPassword, '$2y$') && $inputPassword === $storedPassword) {
            // Legacy plain-text password matches — upgrade it to bcrypt now
            $user->password = Hash::make($inputPassword);
            $user->save();
            $authenticated = true;
        }

        if ($authenticated) {
            // Check if account is blocked
            if ($user->blockstatus == 1) {
                return back()->withErrors([
                    'login_id' => 'Your account has been temporarily blocked. Please contact our customer support for further details.',
                ])->onlyInput('login_id');
            }

            // Check if account is rejected
            if ($user->status == 2) {
                return back()->withErrors([
                    'login_id' => 'Your account has been rejected. Please contact our customer support for further details.',
                ])->onlyInput('login_id');
            }

            // Check if account is deleted
            if ($user->status == 0) {
                return back()->withErrors([
                    'login_id' => 'Your account has been deleted. Please contact our customer support for further details.',
                ])->onlyInput('login_id');
            }

            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'login_id' => 'The password you entered is incorrect.',
        ])->onlyInput('login_id');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/home');
    }

    public function forgotPassword(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Forgot Password hit: ' . $request->email);
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        $user = Profile::where('email_id', $email)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'No account found with this email address.']);
        }

        $otp = rand(100000, 999999);
        \Illuminate\Support\Facades\Session::put('reset_otp', $otp);
        \Illuminate\Support\Facades\Session::put('reset_email', $email);

        try {
            \Illuminate\Support\Facades\Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($email) {
                $message->to($email)->subject('Password Reset OTP - Thennadu Matrimony');
            });
            return response()->json(['success' => true, 'message' => 'OTP sent to your email.']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Password Reset OTP Failure: ' . $e->getMessage(), [
                'email' => $email,
                'exception' => $e
            ]);
            return response()->json(['success' => false, 'message' => 'Failed to send OTP: ' . $e->getMessage()]);
        }
    }

    public function verifyResetOTP(Request $request)
    {
        $request->validate(['otp' => 'required']);
        if ($request->otp == \Illuminate\Support\Facades\Session::get('reset_otp')) {
            \Illuminate\Support\Facades\Session::put('reset_otp_verified', true);
            return response()->json(['success' => true, 'message' => 'OTP verified.']);
        }
        return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        if (!\Illuminate\Support\Facades\Session::get('reset_otp_verified')) {
            return response()->json(['success' => false, 'message' => 'Session expired or OTP not verified.']);
        }

        $email = \Illuminate\Support\Facades\Session::get('reset_email');
        $user = Profile::where('email_id', $email)->first();
        
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            
            \Illuminate\Support\Facades\Session::forget(['reset_otp', 'reset_email', 'reset_otp_verified']);
            return response()->json(['success' => true, 'message' => 'Password reset successful. Please login.']);
        }

        return response()->json(['success' => false, 'message' => 'User not found.']);
    }
}
