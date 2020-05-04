<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Domain\Geolocation\Models\Geolocation;
use Domain\Meet\Meet;
use Faker\Generator as Faker;

$factory->define(Meet::class, static function (Faker $faker) {
    return [
        'geolocation_from' => static function () {
            return factory(Geolocation::class)->create();
        },
        'geolocation_to' => static function () {
            return factory(Geolocation::class)->create();
        },
    ];
});
