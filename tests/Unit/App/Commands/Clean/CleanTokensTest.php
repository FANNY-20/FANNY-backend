<?php

namespace Tests\Unit\App\Commands\Clean;

use Database\Factories\Token\TokenFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Commands\Clean\CleanTokens
 */
class CleanTokensTest extends TestCase
{
    /**
     * @test
     * @covers ::handle
     */
    public function tokensAreCleared()
    {
        Carbon::setTestNow(now());

        $activeToken = TokenFactory::new()->createOne();
        $oldToken = TokenFactory::new()->updatedAt(now()->subWeeks(3))->createOne();

        Artisan::call('stop-covid:clean-tokens');

        $this->assertDatabaseHas('tokens', [
            'id' => $activeToken->id,
        ]);

        $this->assertDatabaseMissing('tokens', [
            'id' => $oldToken->id,
        ]);
    }
}
