<?php

use Support\Http\Middleware\AuthenticateApp;

Route::group(['middleware' => AuthenticateApp::class], static function (): void {
});
