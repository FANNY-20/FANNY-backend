<?php

namespace App\Api\Controllers;

use App\Api\Requests\CreateGeolocationRequest;
use App\Api\Requests\UpdateGeolocationRequest;
use Domain\Geolocation\Actions\CreateGeolocationAction;
use Domain\Geolocation\Actions\UpdateGeolocationAction;
use Domain\Geolocation\DTO\CreateGeolocationDTO;
use Domain\Geolocation\DTO\UpdateGeolocationDTO;
use Illuminate\Http\JsonResponse;

class GeolocationController
{
    public function store(CreateGeolocationRequest $request, CreateGeolocationAction $storeAction): JsonResponse
    {
        $data = CreateGeolocationDTO::fromRequest($request);

        $storeAction->execute($data);

        return response()->json();
    }

    public function update(UpdateGeolocationRequest $request, UpdateGeolocationAction $updateAction): JsonResponse
    {
        $data = UpdateGeolocationDTO::fromRequest($request);

        $updateAction->execute($data);

        return response()->json();
    }
}
