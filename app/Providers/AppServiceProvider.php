<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Inertia::share('appUrl',env('APP_URL'));
        Inertia::share('flash',function(){
            return [
                "success" => Session::get('success')
            ];
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(env("APP_ENV") == "production") URL::forceScheme('https');
    }
}
