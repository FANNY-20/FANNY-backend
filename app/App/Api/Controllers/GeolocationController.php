<?php

namespace App\Api\Controllers;

use App\Api\Requests\StoreGeolocationRequest;
use Domain\Geolocation\Actions\CreateGeolocationAction;
use Domain\Geolocation\DTO\CreateGeolocationDTO;
use Illuminate\Http\JsonResponse;

class GeolocationController
{
    public function store(StoreGeolocationRequest $request, CreateGeolocationAction $storeAction): JsonResponse
    {
        $data = CreateGeolocationDTO::fromRequest($request);

        $storeAction->execute($data);

        return response()->json();
    }
}
