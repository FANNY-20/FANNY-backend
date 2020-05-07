<?php

namespace Tests\Feature\Api\TokenController;

use Tests\TestCase;

/**
 * @coversDefaultClass \App\Api\Controllers\TokenController
 */
class StoreTokenTest extends TestCase
{
    /**
     * @test
     * @covers ::store
     */
    public function tokensIsCreated()
    {
        $this->postJson(
            'api/tokens',
            ['tokens' => ['foo', 'bar']],
            ['Authorization' => 'Bearer some-random-string']
        )->assertCreated();

        $this->assertDatabaseHas('tokens', [
            'value' => 'foo',
        ]);

        $this->assertDatabaseHas('tokens', [
            'value' => 'bar',
        ]);
    }

    /**
     * @test
     * @covers ::store
     */
    public function tokensIsRequired()
    {
        $this->postJson(
            'api/tokens',
            [],
            ['Authorization' => 'Bearer some-random-string']
        )
            ->assertStatus(422)
            ->assertJsonPath('errors', [
                'tokens' => ['The tokens field is required.'],
            ]);
    }
}
