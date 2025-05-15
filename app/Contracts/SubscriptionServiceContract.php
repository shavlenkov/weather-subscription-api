<?php

namespace App\Contracts;

interface SubscriptionServiceContract
{
    public function createSubscription(array $data): array;
    public function confirmSubscription(string $token): array;
    public function unsubscribe(string $token): array;
}
