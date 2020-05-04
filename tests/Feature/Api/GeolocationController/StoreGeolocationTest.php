<?php

namespace Tests\Feature\Api\GeolocationController;

use Domain\Geolocation\Models\Geolocation;
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
        )->assertSuccessful();

        $this->assertDatabaseHas('geolocations', [
            'uuid' => 'azerty123456',
        ]);
    }

    /**
     * @test
     * @covers ::store
     */
    public function geolocationIsUpdated()
    {
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

    /**
     * @test
     * @covers ::store
     */
    public function uuidMustBeUnique()
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
        )
            ->assertStatus(422)
            ->assertJsonPath('errors', [
                'uuid' => ['The uuid has already been taken.'],
            ]);
    }
}
