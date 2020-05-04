<?php

use App\Api\Controllers\GeolocationController;
use Support\Http\Middleware\AuthenticateApp;

Route::group(['middleware' => AuthenticateApp::class], static function (): void {
    Route::group(['prefix' => 'geolocations'], static function (): void {
        Route::post('/', [GeolocationController::class, 'store']);
    });
});
