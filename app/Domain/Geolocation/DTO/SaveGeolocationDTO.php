<?php

namespace Domain\Geolocation\DTO;

use App\Api\Requests\CreateGeolocationRequest;
use App\Api\Requests\UpdateGeolocationRequest;
use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Spatie\DataTransferObject\DataTransferObject;

class SaveGeolocationDTO extends DataTransferObject
{
    public ?Geolocation $geolocation;

    public ?string $uuid;

    public Point $location;

    public static function fromCreateRequest(CreateGeolocationRequest $request): self
    {
        return new self([
            'uuid' => $request->uuid,
            'location' => new Point($request->lat, $request->lon),
        ]);
    }

    public static function fromUpdateRequest(UpdateGeolocationRequest $request): self
    {
        return new self([
            'geolocation' => $request->geolocation,
            'location' => new Point($request->lat, $request->lon),
        ]);
    }
}
