<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate(
            [
                'email'=>'required',
                'password'=>'required'
            ]
            );

            $email = $request->input('email');
            $password = $request->input('password');


            if(Auth::attempt(['email'=>$email,'password'=>$password]))
            {


                $user = User::where('email',$email)->first();

                    if($user->broker_id == null)
                    {
                        if ($user->email == 'thennadumatrimony@gmail.com' || in_array($user->role, [1, 2])) {
                           Auth::login($user);
                               // Log the login
                               DB::table('logdetails_tb')->insert([
                                   'user_id' => $user->user_ID ?? $user->email,
                                   'user_ip' => $request->ip(),
                               ]);
                               return redirect('dashboard');
                        } else {
                            Auth::logout();
                            return redirect('/login')->with('error',' Access Restricted to Admin only ');
                        }
                    }
                    else
                    {
                            if($user->broker_approval_status == 0)
                            {
                                Auth::logout();

                                return redirect('/login')->with('error',' Your Profile is Not Approved');
                            }
                            else
                            {
                                // return "broker approved";
                                   Auth::login($user);
                                   // Log the login
                                   DB::table('logdetails_tb')->insert([
                                       'user_id' => $user->user_ID ?? $user->email,
                                       'user_ip' => $request->ip(),
                                   ]);
                                       return redirect('dashboard')->with('user',$user);
                            }
                    }
            //    Auth::login($user);


            //     return redirect('dashboard');
            }
            else
            {
                return redirect('/login')->with('error',' Username Password incorrect..!!');
            }
    }


    public function logout(){
        Auth::logout();

        return redirect('/login');
    }
}


