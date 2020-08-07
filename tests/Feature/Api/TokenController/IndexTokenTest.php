<?php

namespace Tests\Feature\Api\TokenController;

use Database\Factories\Token\TokenFactory;
use Domain\Token\Models\Token;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Api\Controllers\TokenController
 */
class IndexTokenTest extends TestCase
{
    /**
     * @test
     * @covers ::index
     */
    public function tokensIsRetrieved()
    {
        $tokens = TokenFactory::times(3)->create();

        $this->getJson(
            'api/tokens',
            ['Authorization' => 'Bearer some-random-string']
        )
            ->assertSuccessful()
            ->assertJsonPath('data', $tokens->map(static function (Token $token) {
                return ['token' => $token->value];
            })->all());
    }
}
