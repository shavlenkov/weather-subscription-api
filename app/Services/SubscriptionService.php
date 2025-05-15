<?php

namespace App\Services;

use App\Contracts\SubscriptionServiceContract;
use App\Models\Subscription;

/**
 * SubscriptionService class
 *
 * Handles user subscriptions including creation, confirmation, and unsubscription
 */
class SubscriptionService implements SubscriptionServiceContract
{
    /**
     * Constructor of SubscriptionService class
     *
     * @param TokenService $tokenService
     */
    public function __construct(public TokenService $tokenService)
    {
    }

    /**
     * Creates a new subscription if the email is not already subscribed
     *
     * @param array $data An associative array with keys: 'email', 'city', 'frequency'
     * @return array Returns a status and message or the created subscription data
     */
    public function createSubscription(array $data): array
    {
        [
            'email' => $email,
            'city' => $city,
            'frequency' => $frequency,
        ] = $data;

        if (Subscription::where('email', $email)->exists()) {
            return ['status' => false, 'message' => 'Email already subscribed'];
        }

        $subscription = Subscription::create([
            'email' => $email,
            'city' => $city,
            'frequency' => $frequency,
            'token' => $this->tokenService->generateToken(),
        ]);

        return ['status' => true, 'data' => $subscription];
    }

    /**
     * Confirms a subscription using a token
     *
     * @param string $token The confirmation token
     * @return array Returns a status and message indicating success or failure
     */
    public function confirmSubscription(string $token): array
    {
        $subscription = Subscription::where('token', $token)->first();

        if (!$subscription) {
            return ['status' => false, 'message' => 'Token not found'];
        }

        $subscription->confirmed = true;
        $subscription->last_report_date = now();
        $subscription->token = $this->tokenService->generateToken();

        $subscription->save();

        return ['status' => true, 'message' => 'Subscription confirmed successfully'];
    }

    /**
     * Unsubscribes a user using a token
     *
     * @param string $token The unsubscription token
     * @return array Returns a status and message indicating success or failure
     */
    public function unsubscribe(string $token): array
    {
        $subscription = Subscription::where('token', $token)->first();

        if (!$subscription) {
            return ['status' => false, 'message' => 'Token not found'];
        }

        $subscription->delete();

        return ['status' => true, 'message' => 'Unsubscribed successfully'];
    }
}
