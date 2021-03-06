<?php

return [
    // The token the hybrid application need to access to API
    'token' => env('APP_TOKEN', 'some-random-string'),

    // The token needed to access to Horizon Dashboard
    'horizon_token' => env('HORIZON_TOKEN', 'some-random-string'),

    'geolocation' => [
        'distance' => 15, // in meters,
        'time' => 30, // in seconds,
    ],

    'clean' => [
        'tokens' => 15, // in days
        'meets' => 15, // in minutes
        'geolocations' => 10, // in minutes
    ],
];
