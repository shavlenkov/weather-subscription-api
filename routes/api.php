<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WeatherController;
use App\Http\Controllers\SubscriptionController;

Route::get('/weather', [WeatherController::class, 'getWeatherByCity'])->name('weather');

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('/confirm/{token}', [SubscriptionController::class, 'confirm'])->name('confirm');
Route::get('/unsubscribe/{token}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');
