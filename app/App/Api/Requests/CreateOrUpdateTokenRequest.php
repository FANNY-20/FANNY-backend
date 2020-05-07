<?php

namespace App\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Soyhuce\Rules\DbRules;

/**
 * @property-read array<string> $tokens
 */
class CreateOrUpdateTokenRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'tokens' => 'present|array',
            'tokens.*' => rules(['required', DbRules::string()]),
        ];
    }
}
