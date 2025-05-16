<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

use App\Models\Subscription;
use App\Services\WeatherService;
use App\Mail\WeatherReportMail;

class SendWeatherReportMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Subscription $subscription)
    {
    }

    public function handle(): void
    {
        $weatherService = app(WeatherService::class);

        $response = $weatherService->getWeatherByCity($this->subscription->city);

        if ($response) {
            Mail::to($this->subscription->email)->send(
                new WeatherReportMail($this->subscription, $response)
            );
        }
    }
}
