<?php

namespace Tests\Unit\Domain\Geolocation\Actions;

use Domain\Geolocation\Actions\SaveGeolocationAction;
use Domain\Geolocation\DTO\GeolocationDTO;
use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domain\Geolocation\Actions\SaveGeolocationAction
 */
class CreateGeolocationActionTest extends TestCase
{
    /**
     * @test
     * @covers ::execute
     */
    public function geolocationIsCreated()
    {
        $data = new GeolocationDTO([
            'uuid' => 'azerty123456789',
            'location' => new Point(15.55, -5.66),
        ]);

        app(SaveGeolocationAction::class)->execute($data);

        $geolocation = Geolocation::whereUuid('azerty123456789')->first();

        $this->assertNotNull($geolocation);

        $this->assertEquals(new Point(15.55, -5.66), $geolocation->location);
    }

    /**
     * @test
     * @covers ::execute
     */
    public function geolocationIsUpdated()
    {
        $geolocation = factory(Geolocation::class)->create([
            'uuid' => 'azerty123456789',
            'location' => new Point(10, -10),
        ]);

        $data = new GeolocationDTO([
            'uuid' => $geolocation->uuid,
            'location' => new Point(15.55, -5.66),
        ]);

        app(SaveGeolocationAction::class)->execute($data);

        $geolocation->refresh();

        $this->assertEquals(new Point(15.55, -5.66), $geolocation->location);
    }
}
