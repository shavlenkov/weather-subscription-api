<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Subscription;
use App\Jobs\SendWeatherReportMailJob;

class SendWeatherReportsCommand extends Command
{
    protected $signature = 'send:weather-reports';
    protected $description = 'Send weather reports to confirmed subscriptions based on frequency';

    public function handle(): void
    {
        $now = now();

        Subscription::where('confirmed', true)
            ->where('frequency', 'hourly')
            ->whereNotNull('last_report_date')
            ->where('last_report_date', '<=', $now->subHour())
            ->get()
            ->each(function ($subscription) {
                SendWeatherReportMailJob::dispatch($subscription);

                $subscription->update(['last_report_date' => now()]);
            });

        Subscription::where('confirmed', true)
            ->where('frequency', 'daily')
            ->whereNotNull('last_report_date')
            ->where('last_report_date', '<=', $now->subDay())
            ->get()
            ->each(function ($subscription) {
                SendWeatherReportMailJob::dispatch($subscription);

                $subscription->update(['last_report_date' => now()]);
            });
    }
}
