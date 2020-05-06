<?php

namespace Tests\Unit\Domain\Meet\Actions;

use Domain\Geolocation\Models\Geolocation;
use Domain\Meet\Actions\CreateMeetAction;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domain\Meet\Actions\CreateMeetAction
 */
class CreateMeetActionTest extends TestCase
{
    /**
     * @test
     * @covers ::execute
     */
    public function meetIsCreated()
    {
        Carbon::setTestNow(now());

        $geolocation = factory(Geolocation::class)->create();

        $otherGeolocation = factory(Geolocation::class)->create();

        $this->assertDatabaseMissing('meets', [
            'geolocation_from' => $geolocation->uuid,
            'geolocation_to' => $otherGeolocation->uuid,
        ]);

        $this->assertDatabaseMissing('meets', [
            'geolocation_from' => $otherGeolocation->uuid,
            'geolocation_to' => $geolocation->uuid,
        ]);

        app(CreateMeetAction::class)->execute($geolocation, $otherGeolocation->uuid);

        $this->assertDatabaseHas('meets', [
            'geolocation_from' => $geolocation->uuid,
            'geolocation_to' => $otherGeolocation->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->assertDatabaseHas('meets', [
            'geolocation_from' => $otherGeolocation->uuid,
            'geolocation_to' => $geolocation->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
