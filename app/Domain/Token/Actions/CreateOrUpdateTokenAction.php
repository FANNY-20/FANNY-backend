<?php

namespace Domain\Token\Actions;

use Domain\Token\Models\Token;
use Illuminate\Support\Str;

class CreateOrUpdateTokenAction
{
    /**
     * @param array<string> $tokens
     */
    public function execute(array $tokens): void
    {
        /** @var string $token */
        foreach ($tokens as $token) {
            Token::updateOrCreate([
                'value' => $token,
            ], [
                'random_value' => Str::orderedUuid(),
            ]);
        }
    }
}
