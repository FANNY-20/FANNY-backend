<?php

namespace App\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Soyhuce\Rules\DbRules;

/**
 * @property-read string $uuid
 * @property-read float $lat
 * @property-read float $lon
 */
class CreateGeolocationRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'uuid' => rules(['required', DbRules::string(), 'unique:geolocations,uuid']),
            'lat' => 'required|numeric|min:-90|max:90',
            'lon' => 'required|numeric|min:-180|max:180',
        ];
    }
}
