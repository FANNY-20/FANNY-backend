<?php

use App\Api\Controllers\GeolocationController;
use App\Api\Controllers\TokenController;
use Support\Http\Middleware\AuthenticateApp;

Route::group(['middleware' => AuthenticateApp::class], static function (): void {
    Route::post('geolocations', [GeolocationController::class, 'store']);

    Route::post('tokens', [TokenController::class, 'store']);
});
