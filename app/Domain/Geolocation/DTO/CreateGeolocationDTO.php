<?php

namespace Domain\Geolocation\DTO;

use App\Api\Requests\CreateGeolocationRequest;
use Domain\Geolocation\Models\Point;
use Spatie\DataTransferObject\DataTransferObject;

class CreateGeolocationDTO extends DataTransferObject
{
    public string $uuid;

    public Point $location;

    public static function fromRequest(CreateGeolocationRequest $request): self
    {
        return new self([
            'uuid' => $request->uuid,
            'location' => new Point($request->lat, $request->lon),
        ]);
    }
}
