<?php

namespace App\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'tokens.*' => 'required|string|max:255',
        ];
    }
}
