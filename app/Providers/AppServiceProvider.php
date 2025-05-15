<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\WeatherService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WeatherService::class, function () {
            return new WeatherService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
