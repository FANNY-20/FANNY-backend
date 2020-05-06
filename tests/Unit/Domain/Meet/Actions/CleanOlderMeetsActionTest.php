<?php

namespace Tests\Unit\Domain\Meet\Actions;

use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Domain\Meet\Actions\CleanOlderMeetsAction;
use Domain\Meet\Models\Meet;
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
        $geolocation = factory(Geolocation::class)->create(
            ['location' => new Point(49.172627687418, -0.37168979644775)]
        );
        $meet = factory(Meet::class)->create([
            'geolocation_from' => $geolocation->uuid,
        ]);

        $otherMeet = factory(Meet::class)->create([
            'geolocation_from' => $geolocation->uuid,
            'geolocation_to' => factory(Geolocation::class)->create(
                ['location' => new Point(49.172701337742, -0.37175953388214)]
            ),
        ]);

        app(CleanOlderMeetsAction::class)->execute($geolocation, [$otherMeet->geolocation_to]);

        $this->assertDatabaseHas('meets', [
            'id' => $otherMeet->id,
        ]);

        $this->assertDatabaseMissing('meets', [
            'id' => $meet->id,
        ]);
    }
}
