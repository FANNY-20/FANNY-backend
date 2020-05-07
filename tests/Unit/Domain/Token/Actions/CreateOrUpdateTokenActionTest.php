<?php

namespace Tests\Unit\Domain\Token\Actions;

use Domain\Token\Actions\CreateOrUpdateTokenAction;
use Domain\Token\Models\Token;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domain\Token\Actions\CreateOrUpdateTokenAction
 */
class CreateOrUpdateTokenActionTest extends TestCase
{
    /**
     * @test
     * @covers ::execute
     */
    public function tokensIsCreated()
    {
        app(CreateOrUpdateTokenAction::class)->execute(['azerty', 'wxcvb']);

        $this->assertDatabaseHas('tokens', [
            'value' => 'azerty',
        ]);

        $this->assertDatabaseHas('tokens', [
            'value' => 'wxcvb',
        ]);
    }

    /**
     * @test
     * @covers ::execute
     */
    public function tokensIsUpdated()
    {
        $today = now();
        $yesterday = $today->copy()->subDay();

        Carbon::setTestNow($yesterday);

        $token = factory(Token::class)->create();

        Carbon::setTestNow($today);

        app(CreateOrUpdateTokenAction::class)->execute(['azerty', $token->value]);

        $token->refresh();

        $this->assertDatabaseHas('tokens', [
            'id' => $token->id,
            'value' => $token->value,
            'created_at' => $yesterday->toDateTimeString(),
            'updated_at' => $today->toDateTimeString(),
        ]);

        $this->assertDatabaseHas('tokens', [
            'value' => 'azerty',
        ]);
    }
}
