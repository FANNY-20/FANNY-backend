<?php

namespace Tests\Unit\App\Commands\Clean;

use Database\Factories\Meet\MeetFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Commands\Clean\CleanMeets
 */
class CleanMeetsTest extends TestCase
{
    /**
     * @test
     * @covers ::handle
     */
    public function meetsAreCleared()
    {
        Carbon::setTestNow(now());

        $activeMeet = MeetFactory::new()->createOne();
        $oldMeet = MeetFactory::new()->updatedAt(now()->subMinutes(18))->createOne();

        Artisan::call('stop-covid:clean-meets');

        $this->assertDatabaseHas('meets', [
            'id' => $activeMeet->id,
        ]);

        $this->assertDatabaseMissing('meets', [
            'id' => $oldMeet->id,
        ]);
    }
}
