<?php

namespace Database\Seeders;

use Domain\Geolocation\Models\Geolocation;
use Illuminate\Database\Seeder;

class GeolocationsSeeder extends Seeder
{
    public function run(): void
    {
        factory(Geolocation::class, 10)->create();
    }
}
