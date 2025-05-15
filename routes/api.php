<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WeatherController;
use App\Http\Controllers\SubscriptionController;

Route::get('/weather', [WeatherController::class, 'getWeatherByCity']);

Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
Route::get('/confirm/{token}', [SubscriptionController::class, 'confirm']);
Route::get('/unsubscribe/{token}', [SubscriptionController::class, 'unsubscribe']);
