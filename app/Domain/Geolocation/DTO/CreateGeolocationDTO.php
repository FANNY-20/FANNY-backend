<?php

namespace Domain\Geolocation\DTO;

use App\Api\Requests\StoreGeolocationRequest;
use Domain\Geolocation\Models\Point;
use Spatie\DataTransferObject\DataTransferObject;

class CreateGeolocationDTO extends DataTransferObject
{
    public string $uuid;

    public Point $location;

    public static function fromRequest(StoreGeolocationRequest $request): self
    {
        return new self([
            'uuid' => $request->uuid,
            'location' => new Point($request->lat, $request->lon),
        ]);
    }
}
