<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

use App\Contracts\WeatherServiceContract;

/**
 * WeatherService class
 *
 * Service for retrieving weather information using an external API
 */
class WeatherService implements WeatherServiceContract
{
    /**
     * Retrieves weather information for the specified city
     *
     * @param string $city The name of the city to retrieve weather data for
     * @return array|null Returns the weather data as an associative array if successful, or null on failure
     */
    public function getWeatherByCity(string $city): ?array
    {
        $response = Http::get(config('weather.base_url'), [
            'key' => config('weather.api_key'),
            'q' => $city,
            'aqi' => 'no',
        ]);

        if ($response->successful()) {
            $json = $response->json();

            return [
                'temperature' => $json['current']['temp_c'],
                'humidity' => $json['current']['humidity'],
                'description' => $json['current']['condition']['text'],
            ];
        }

        return null;
    }
}
