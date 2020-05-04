<?php

use App\Api\Controllers\GeolocationController;
use Support\Http\Middleware\AuthenticateApp;

Route::group(['middleware' => AuthenticateApp::class], static function (): void {
    Route::post('geolocations', [GeolocationController::class, 'store']);
});
