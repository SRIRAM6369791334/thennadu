<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;








class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\register::observe(\App\Observers\RegisterObserver::class);
        // dd(auth()->user());


        try {
            $adminnotification = DB::table('admin_notifications')
                ->where('notification_view', 0)
                ->orderBy('id', 'desc')
                ->get();
        } catch (\Exception $e) {
            $adminnotification = collect();
        }


        View::share('adminnotification',$adminnotification);

        // $paths = $request->path();
        // View::share('paths',$adminnotification);

    view()->composer('*', function($view) {
            $view->with('user', auth()->user());
        });




    }
}


