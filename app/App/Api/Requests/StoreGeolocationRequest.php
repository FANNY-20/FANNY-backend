<?php

namespace App\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeolocationRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'uuid' => 'required|string|unique:geolocations,uuid',
            'lat' => 'required|numeric|min:-90|max:90',
            'lon' => 'required|numeric|min:-180|max:180',
        ];
    }
}
