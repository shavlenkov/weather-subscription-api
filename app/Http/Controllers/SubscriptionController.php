<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Http\Requests\ConfirmSubscriptionRequest;
use App\Http\Requests\SubscribeRequest;
use App\Http\Requests\UnsubscribeRequest;
use App\Services\SubscriptionService;
use App\Events\SubscriptionCreated;

/**
 * SubscriptionController class
 *
 * Handles subscription actions such as subscribing, confirming, and unsubscribing
 */
class SubscriptionController extends Controller
{
    /**
     * Constructor of SubscriptionController class
     *
     * @param SubscriptionService $subscriptionService
     */
    public function __construct(public SubscriptionService $subscriptionService)
    {
    }

    /**
     * Handles the subscription request
     *
     * @param SubscribeRequest $request Validated subscription request containing email, city, and frequency
     * @return JsonResponse JSON response indicating success or failure
     *
     * @OA\Post(
     *     path="/api/subscribe",
     *     tags={"Subscription"},
     *     summary="Subscribe to weather updates",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "city", "frequency"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="city", type="string", example="Kyiv"),
     *             @OA\Property(property="frequency", type="string", enum={"daily", "hourly"}, example="hourly")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Subscription successful. Confirmation email sent."
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Invalid input"
     *      ),
     *     @OA\Response(
     *         response=409,
     *         description="Email already subscribed"
     *     )
     * )
     */
    public function subscribe(SubscribeRequest $request): JsonResponse
    {
        $data = $request->validated();

        $result = $this->subscriptionService->createSubscription($data);

        if (!$result['status']) {
            return response()->json(['error' => $result['message']], 409);
        }

        event(new SubscriptionCreated($result['data']));

        return response()->json(['message' => 'Subscription successful. Confirmation email sent.']);
    }

    /**
     * Confirms a subscription using a token
     *
     * @param ConfirmSubscriptionRequest $request Validated request containing a token
     * @return JsonResponse JSON response indicating success or failure
     *
     * @OA\Get(
     *     path="/api/confirm/{token}",
     *     tags={"Subscription"},
     *     summary="Confirm a subscription",
     *     @OA\Parameter(
     *          name="token",
     *          in="path",
     *          required=true,
     *          description="The token associated with the subscription",
     *          @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Subscription confirmed successfully"
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Invalid token"
     *      ),
     *     @OA\Response(
     *         response=404,
     *         description="Token not found"
     *     )
     * )
     */
    public function confirm(ConfirmSubscriptionRequest $request): JsonResponse
    {
        $data = $request->validated();

        $result = $this->subscriptionService->confirmSubscription($data['token']);

        return $result['status']
            ? response()->json(['message' => $result['message']])
            : response()->json(['error' => $result['message']], 404);
    }

    /**
     * Unsubscribes a user using a token
     *
     * @param UnsubscribeRequest $request Validated request containing a token
     * @return JsonResponse JSON response indicating success or failure
     *
     * @OA\Get(
     *     path="/api/unsubscribe/{token}",
     *     tags={"Subscription"},
     *     summary="Unsubscribe using token",
     *     @OA\Parameter(
     *         name="token",
     *         in="path",
     *         required=true,
     *         description="The token associated with the subscription",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Unsubscribed successfully"
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Invalid token"
     *      ),
     *     @OA\Response(
     *         response=404,
     *         description="Token not found"
     *     )
     * )
     */
    public function unsubscribe(UnsubscribeRequest $request): JsonResponse
    {
        $data = $request->validated();

        $result = $this->subscriptionService->unsubscribe($data['token']);

        return $result['status']
            ? response()->json(['message' => $result['message']])
            : response()->json(['error' => $result['message']], 404);
    }
}
