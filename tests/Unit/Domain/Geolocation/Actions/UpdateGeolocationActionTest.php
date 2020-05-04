<?php

namespace Tests\Unit\Domain\Geolocation\Actions;

use Domain\Geolocation\Actions\UpdateGeolocationAction;
use Domain\Geolocation\DTO\UpdateGeolocationDTO;
use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domain\Geolocation\Actions\UpdateGeolocationAction
 */
class UpdateGeolocationActionTest extends TestCase
{
    /**
     * @test
     * @covers ::execute
     */
    public function geolocationIsUpdated()
    {
        $geolocation = factory(Geolocation::class)->create(
            ['location' => new Point(11, -11)]
        );

        $data = new UpdateGeolocationDTO([
            'geolocation' => $geolocation,
            'location' => new Point(10, -10),
        ]);

        app(UpdateGeolocationAction::class)->execute($data);

        $this->assertEquals(new Point(10, -10), $geolocation->location);
    }
}
