<?php

namespace Tests\Unit\App\Commands\Clean;

use Database\Factories\Geolocation\GeolocationFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Commands\Clean\CleanGeolocations
 */
class CleanGeolocationsTest extends TestCase
{
    /**
     * @test
     * @covers ::handle
     */
    public function geolocationsAreCleared()
    {
        Carbon::setTestNow(now());

        $activeGeolocation = GeolocationFactory::new()->createOne();
        $oldGeolocation = GeolocationFactory::new()->updatedAt(now()->subMinutes(11))->createOne();

        Artisan::call('stop-covid:clean-geolocations');

        $this->assertDatabaseHas('geolocations', [
            'uuid' => $activeGeolocation->uuid,
        ]);

        $this->assertDatabaseMissing('geolocations', [
            'uuid' => $oldGeolocation->uuid,
        ]);
    }
}
