<?php

namespace App\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read \Domain\Geolocation\Models\Geolocation $geolocation
 * @property-read float $lat
 * @property-read float $lon
 */
class UpdateGeolocationRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'lat' => 'required|numeric|min:-90|max:90',
            'lon' => 'required|numeric|min:-180|max:180',
        ];
    }
}
