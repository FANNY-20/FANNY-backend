<?php

namespace Tests\Unit\Domain\Meet\Actions;

use Database\Factories\Meet\MeetFactory;
use Domain\Meet\Actions\UpdateMeetAction;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domain\Meet\Actions\UpdateMeetAction
 */
class UpdateMeetActionTest extends TestCase
{
    /**
     * @test
     * @covers ::execute
     */
    public function meetIsUpdated()
    {
        Carbon::setTestNow(now());

        $meet = MeetFactory::new()->createOne();

        app(UpdateMeetAction::class)->execute($meet);

        $this->assertDatabaseHas('meets', [
            'geolocation_from' => $meet->from->uuid,
            'geolocation_to' => $meet->to->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
