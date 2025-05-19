<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;

use App\Events\SubscriptionCreated;
use App\Mail\ConfirmSubscriptionMail;
use App\Services\WeatherService;

class SendMailSubscriptionCreatedListener
{
    /**
     * Handle the event.
     */
    public function handle(SubscriptionCreated $event): void
    {
        $weatherService = app(WeatherService::class);

        $response = $weatherService->getWeatherByCity($event->subscription->city);

        if ($response) {
            Mail::to($event->subscription->email)->send(
                new ConfirmSubscriptionMail($event->subscription)
            );
        }
    }
}
