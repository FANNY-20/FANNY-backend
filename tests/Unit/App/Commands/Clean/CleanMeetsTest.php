<?php

namespace Tests\Unit\App\Commands\Clean;

use Domain\Meet\Models\Meet;
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

        $activeMeet = factory(Meet::class)->create();
        $oldMeet = factory(Meet::class)->create([
            'updated_at' => now()->subMinutes(18),
        ]);

        Artisan::call('stop-covid:clean-meets');

        $this->assertDatabaseHas('meets', [
            'id' => $activeMeet->id,
        ]);

        $this->assertDatabaseMissing('meets', [
            'id' => $oldMeet->id,
        ]);
    }
}
