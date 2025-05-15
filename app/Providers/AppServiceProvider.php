<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

use App\Services\WeatherService;
use App\Services\TokenService;
use App\Services\SubscriptionService;

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

        $this->app->bind(TokenService::class, function () {
            return new TokenService();
        });

        $this->app->bind(SubscriptionService::class, function (Application $app) {
            return new SubscriptionService($app->make(TokenService::class));
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
