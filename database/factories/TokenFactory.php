<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Domain\Token\Models\Token;
use Faker\Generator as Faker;

$factory->define(Token::class, static function (Faker $faker) {
    return [
        'value' => $faker->unique()->sha256,
        'random_value' => $faker->unique()->sha256,
    ];
});
