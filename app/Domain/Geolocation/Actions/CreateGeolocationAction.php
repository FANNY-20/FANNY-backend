<?php

namespace Domain\Geolocation\Actions;

use Domain\Geolocation\DTO\SaveGeolocationDTO;
use Domain\Geolocation\Models\Geolocation;

class CreateGeolocationAction
{
    public function execute(SaveGeolocationDTO $data): Geolocation
    {
        return Geolocation::create([
            'uuid' => $data->uuid,
            'location' => $data->location,
        ]);
    }
}
