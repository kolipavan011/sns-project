<?php

namespace App\Providers;

use App\Services\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();

        $this->app->singleton(Setting::class, function () {
            return Setting::make(storage_path('app/settings.json'));
        });
    }
}
