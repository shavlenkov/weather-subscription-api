<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;

use App\Events\SubscriptionCreated;
use App\Mail\ConfirmSubscriptionMail;

class SendMailSubscriptionCreatedListener
{
    /**
     * Handle the event.
     */
    public function handle(SubscriptionCreated $event): void
    {
        Mail::to($event->subscription->email)->send(
            new ConfirmSubscriptionMail($event->subscription)
        );
    }
}
