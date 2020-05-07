<?php

namespace Tests\Unit\App\Commands\Clean;

use Domain\Geolocation\Models\Geolocation;
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

        $activeGeolocation = factory(Geolocation::class)->create();
        $oldGeolocation = factory(Geolocation::class)->create([
            'updated_at' => now()->subMinutes(11),
        ]);

        Artisan::call('stop-covid:clean-geolocations');

        $this->assertDatabaseHas('geolocations', [
            'uuid' => $activeGeolocation->uuid,
        ]);

        $this->assertDatabaseMissing('geolocations', [
            'uuid' => $oldGeolocation->uuid,
        ]);
    }
}
