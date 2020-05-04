<?php

namespace Tests\Unit\Domain\Geolocation\Actions;

use Domain\Geolocation\Actions\CreateGeolocationAction;
use Domain\Geolocation\DTO\SaveGeolocationDTO;
use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domain\Geolocation\Actions\CreateGeolocationAction
 */
class CreateGeolocationActionTest extends TestCase
{
    /**
     * @test
     * @covers ::execute
     */
    public function geolocationIsCreated()
    {
        $data = new SaveGeolocationDTO([
            'uuid' => 'azerty123456789',
            'location' => new Point(15.55, -5.66),
        ]);

        app(CreateGeolocationAction::class)->execute($data);

        $geolocation = Geolocation::whereUuid('azerty123456789')->first();

        $this->assertNotNull($geolocation);

        $this->assertEquals(new Point(15.55, -5.66), $geolocation->location);
    }
}
