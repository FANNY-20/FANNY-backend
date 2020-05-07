<?php

namespace Domain\Geolocation\DTO;

use App\Api\Requests\CreateOrUpdateGeolocationRequest;
use Domain\Geolocation\Models\Point;
use Spatie\DataTransferObject\DataTransferObject;

class GeolocationDTO extends DataTransferObject
{
    public ?string $uuid;

    public Point $location;

    public static function fromRequest(CreateOrUpdateGeolocationRequest $request): self
    {
        return new self([
            'uuid' => $request->uuid,
            'location' => new Point($request->lat, $request->lon),
        ]);
    }
}
