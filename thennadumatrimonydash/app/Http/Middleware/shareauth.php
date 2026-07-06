<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class shareauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $userlogin = $user->role;
            $username = $user->name;
            $usersID = $user->user_ID;

            if ($userlogin) {
                $menus = DB::table('menupermissions')
                    ->select('*')
                    ->where($usersID, '=', 0)
                    ->get();
                View::share('menus', $menus);
            }
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}


