<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS + fix proxy headers
        if (app()->environment('production')) {
            // Force Laravel to treat request as HTTPS
            if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
                $_SERVER['HTTPS'] = 'on';
            }
            URL::forceScheme('https');
        }
    }
}