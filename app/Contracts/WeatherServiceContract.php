<?php

namespace App\Contracts;

interface WeatherServiceContract
{
    public function getWeatherByCity(string $city): ?array;
}
