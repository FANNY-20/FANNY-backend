<?php

namespace Tests\Feature\Api\GeolocationController;

use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Domain\Meet\Models\Meet;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Api\Controllers\GeolocationController
 */
class StoreGeolocationTest extends TestCase
{
    /**
     * @test
     * @covers ::store
     */
    public function geolocationIsCreated()
    {
        $this->postJson(
            'api/geolocations',
            [
                'uuid' => 'azerty123456',
                'lat' => 15,
                'lon' => -15,
            ],
            ['Authorization' => 'Bearer some-random-string']
        )
            ->assertSuccessful()
            ->assertJsonPath('data', []);

        $this->assertDatabaseHas('geolocations', [
            'uuid' => 'azerty123456',
        ]);
    }

    /**
     * @test
     * @covers ::store
     */
    public function nearGeolocationAreFound()
    {
        $geolocation = factory(Geolocation::class)->create(
            ['location' => new Point(12, -12)]
        );

        $meet = factory(Meet::class)->create([
            'geolocation_from' => $geolocation->uuid,
            'geolocation_to' => factory(Geolocation::class)->create(
                ['location' => new Point(49.172701337742, -0.37175953388214)]
            ),
            'updated_at' => now()->subSeconds(35),
        ]);

        $this->postJson(
            'api/geolocations',
            [
                'uuid' => $geolocation->uuid,
                'lat' => 49.172627687418,
                'lon' => -0.37168979644775,
            ],
            ['Authorization' => 'Bearer some-random-string']
        )
            ->assertSuccessful()
            ->assertJsonPath('data', [
                ['uuid' => $meet->geolocation_to],
            ]);
    }

    /**
     * @test
     * @covers ::store
     */
    public function geolocationIsUpdated()
    {
        factory(Geolocation::class)->create(['uuid' => 'azerty123456']);

        $this->postJson(
            'api/geolocations',
            [
                'uuid' => 'azerty123456',
                'lat' => 15,
                'lon' => -15,
            ],
            ['Authorization' => 'Bearer some-random-string']
        )->assertSuccessful();

        $this->assertDatabaseHas('geolocations', [
            'uuid' => 'azerty123456',
        ]);
    }

    /**
     * @test
     * @covers ::failed
     */
    public function theBearerTokenMustBeCorrect()
    {
        $this->postJson(
            'api/geolocations',
            [
                'uuid' => 'azerty123456',
                'lat' => 15,
                'lon' => -15,
            ],
            ['Authorization' => 'Bearer foobar']
        )->assertForbidden();

        $this->assertDatabaseMissing('geolocations', [
            'uuid' => 'azerty123456',
        ]);
    }

    /**
     * @test
     * @covers ::store
     */
    public function allFieldsAreRequired()
    {
        $this->postJson(
            'api/geolocations',
            [],
            ['Authorization' => 'Bearer some-random-string']
        )
            ->assertStatus(422)
            ->assertJsonPath('errors', [
                'uuid' => ['The uuid field is required.'],
                'lat' => ['The lat field is required.'],
                'lon' => ['The lon field is required.'],
            ]);
    }
}