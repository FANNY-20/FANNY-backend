<?php

namespace Domain\Geolocation\DTO;

use App\Api\Requests\UpdateGeolocationRequest;
use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateGeolocationDTO extends DataTransferObject
{
    public Geolocation $geolocation;

    public Point $location;

    public static function fromRequest(UpdateGeolocationRequest $request): self
    {
        return new self([
            'geolocation' => $request->geolocation,
            'location' => new Point($request->lat, $request->lon),
        ]);
    }
}
