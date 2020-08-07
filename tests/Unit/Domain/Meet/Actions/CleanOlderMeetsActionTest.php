<?php

namespace Tests\Unit\Domain\Meet\Actions;

use Database\Factories\Geolocation\GeolocationFactory;
use Database\Factories\Meet\MeetFactory;
use Domain\Geolocation\Models\Point;
use Domain\Meet\Actions\CleanOlderMeetsAction;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domain\Meet\Actions\CleanOlderMeetsAction
 */
class CleanOlderMeetsActionTest extends TestCase
{
    /**
     * @test
     * @covers ::execute
     */
    public function olderMeetIsDeleted()
    {
        $geolocation = GeolocationFactory::new()
            ->location(new Point(49.172627687418, -0.37168979644775))
            ->createOne();

        $meet = MeetFactory::new()->geolocationFrom($geolocation)->createOne();

        $otherMeet = MeetFactory::new()
            ->geolocationFrom($geolocation)
            ->for(GeolocationFactory::new()
            ->location(new Point(49.172701337742, -0.37175953388214)), 'to')
            ->createOne();

        app(CleanOlderMeetsAction::class)->execute($geolocation, [$otherMeet->geolocation_to]);

        $this->assertDatabaseHas('meets', [
            'id' => $otherMeet->id,
        ]);

        $this->assertDatabaseMissing('meets', [
            'id' => $meet->id,
        ]);
    }
}
