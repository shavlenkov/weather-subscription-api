<?php

namespace App\Http\Controllers;

use App\Http\Resources\WeatherResource;
use Illuminate\Http\JsonResponse;

use App\Services\WeatherService;
use App\Http\Requests\GetWeatherRequest;

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
