<?php

namespace App\Providers;
use App\Models\Setting;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */public function boot()
    {
        View::share('settings', Setting::pluck('value', 'key'));
    }

}
