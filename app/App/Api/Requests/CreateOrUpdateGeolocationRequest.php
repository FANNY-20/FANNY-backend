<?php

namespace App\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $uuid
 * @property-read float $lat
 * @property-read float $lon
 */
class CreateOrUpdateGeolocationRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'uuid' => 'required|string|max:255',
            'lat' => 'required|numeric|min:-90|max:90',
            'lon' => 'required|numeric|min:-180|max:180',
        ];
    }
}
