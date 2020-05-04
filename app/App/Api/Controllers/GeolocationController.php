<?php

namespace App\Api\Controllers;

use App\Api\Requests\CreateOrUpdateGeolocationRequest;
use Domain\Geolocation\Actions\SaveGeolocationAction;
use Domain\Geolocation\DTO\GeolocationDTO;
use Illuminate\Http\JsonResponse;

class GeolocationController
{
    public function store(CreateOrUpdateGeolocationRequest $request, SaveGeolocationAction $storeAction): JsonResponse
    {
        $data = GeolocationDTO::fromRequest($request);

        $storeAction->execute($data);

        return response()->json();
    }
}
