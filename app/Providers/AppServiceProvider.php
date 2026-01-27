<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set default timezone untuk Carbon ke WIB (Asia/Jakarta)
        Carbon::setLocale('id');
        date_default_timezone_set(config('app.timezone', 'Asia/Jakarta'));

        // Force HTTPS when using Ngrok or Production
        if(config('app.env') === 'production' || str_contains(request()->getHost(), 'ngrok-free.dev')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
            \Illuminate\Http\Request::setTrustedProxies(
                ['*'], // Trust all proxies (Ngrok runs behind a proxy)
                \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO
            );
        }
    }
}
