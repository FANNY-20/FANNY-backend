<?php

namespace App\Api\Controllers;

use App\Api\Requests\CreateOrUpdateGeolocationRequest;
use App\Api\Resources\GeolocationMeetList;
use Domain\Geolocation\Actions\SaveGeolocationAction;
use Domain\Geolocation\DTO\GeolocationDTO;
use Domain\Meet\Actions\FetchMeetsForGeolocation;
use Illuminate\Http\Resources\Json\JsonResource;

class GeolocationController
{
    public function store(
        CreateOrUpdateGeolocationRequest $request,
        SaveGeolocationAction $storeAction,
        FetchMeetsForGeolocation $meetsForGeolocation
    ): JsonResource {
        $data = GeolocationDTO::fromRequest($request);

        $geolocation = $storeAction->execute($data);

        $meets = $meetsForGeolocation->execute($geolocation);

        return GeolocationMeetList::collection($meets);
    }
}
