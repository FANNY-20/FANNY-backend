<?php

namespace Tests\Unit\App\Commands\Clean;

use Domain\Token\Models\Token;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * Class CleanTokensTest
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

        $activeToken = factory(Token::class)->create();
        $oldToken = factory(Token::class)->create([
            'updated_at' => now()->subWeeks(3),
        ]);

        Artisan::call('stop-covid:clean-tokens');

        $this->assertDatabaseHas('tokens', [
            'id' => $activeToken->id,
        ]);

        $this->assertDatabaseMissing('tokens', [
            'id' => $oldToken->id,
        ]);
    }
}
