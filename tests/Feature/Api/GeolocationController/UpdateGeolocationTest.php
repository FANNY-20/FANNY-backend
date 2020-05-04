<?php

namespace Tests\Feature\Api\GeolocationController;

use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Api\Controllers\GeolocationController
 */
class UpdateGeolocationTest extends TestCase
{
    /**
     * @test
     * @covers ::update
     */
    public function geolocationIsUpdated()
    {
        $geolocation = factory(Geolocation::class)->create(['uuid' => 'azerty123456789']);

        $this->putJson(
            "api/geolocations/{$geolocation->uuid}",
            [
                'lat' => 15,
                'lon' => -15,
            ],
            ['Authorization' => 'Bearer some-random-string']
        )->assertSuccessful();

        $geolocation->refresh();

        $this->assertEquals(new Point(15, -15), $geolocation->location);
    }
}
