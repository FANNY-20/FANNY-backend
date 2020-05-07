<?php

namespace App\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \Domain\Token\Models\Token
 */
class TokenList extends JsonResource
{
    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'token' => $this->value,
        ];
    }
}
