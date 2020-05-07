<?php

namespace Domain\Geolocation\Actions;

use Domain\Geolocation\DTO\GeolocationDTO;
use Domain\Geolocation\Models\Geolocation;

class SaveGeolocationAction
{
    public function execute(GeolocationDTO $data): Geolocation
    {
        return Geolocation::updateOrCreate([
            'uuid' => $data->uuid,
        ], [
            'location' => $data->location,
        ]);
    }
}
