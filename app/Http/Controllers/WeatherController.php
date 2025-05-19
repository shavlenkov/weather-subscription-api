<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Services\WeatherService;
use App\Http\Requests\GetWeatherRequest;
use App\Http\Resources\WeatherResource;

/**
 * WeatherController class
 *
 * Handles requests related to weather information
 */
class WeatherController extends Controller
{
    /**
     * Constructor of WeatherController class
     *
     * @param WeatherService $weatherService Service for fetching weather data
     */
    public function __construct(protected WeatherService $weatherService)
    {
    }

    /**
     * Get weather data for the specified city
     *
     * @param GetWeatherRequest $request Validated request containing the city name
     * @return WeatherResource|JsonResponse JSON response with temperature, humidity, and description or a 404 error if city not found
     *
     * @OA\Get(
     *     path="/api/weather",
     *     tags={"Weather"},
     *     summary="Get current weather for a city",
     *     @OA\Parameter(
     *         name="city",
     *         in="query",
     *         required=true,
     *         description="City name",
     *         @OA\Schema(type="string", example="Kyiv")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation - current weather forecast returned",
     *         @OA\JsonContent(
     *             @OA\Property(property="temperature", type="number", format="float", example=24.5),
     *             @OA\Property(property="humidity", type="integer", example=80),
     *             @OA\Property(property="description", type="string", example="Partly cloudy")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request"
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="City not found"
     *      ),
     * )
     */
    public function getWeatherByCity(GetWeatherRequest $request): WeatherResource|JsonResponse
    {
        $data = $request->validated();

        $response = $this->weatherService->getWeatherByCity($data['city']);

        if (!$response) {
            return response()->json(['message' => 'City not found'], 404);
        }

        return new WeatherResource($response);
    }
}
