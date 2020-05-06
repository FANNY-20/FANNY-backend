<?php

namespace Tests\Unit\Domain\Meet\Actions;

use Domain\Meet\Actions\UpdateMeetAction;
use Domain\Meet\Models\Meet;
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

        $meet = factory(Meet::class)->create();

        app(UpdateMeetAction::class)->execute($meet);

        $this->assertDatabaseHas('meets', [
            'geolocation_from' => $meet->from->uuid,
            'geolocation_to' => $meet->to->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
