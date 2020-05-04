<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Domain\Meet\Meet;
use Faker\Generator as Faker;

$factory->define(Geolocation::class, static function (Faker $faker) {
    return [
        'uuid' => $faker->unique()->sha256,
        'location' => new Point($faker->latitude, $faker->longitude),
    ];
});
$factory->afterCreatingState(
    Geolocation::class,
    'with-meets',
    static function (Geolocation $geolocation, Faker $faker) {
        factory(Meet::class)->create(['geolocation_from' => $geolocation]);
    }
);
