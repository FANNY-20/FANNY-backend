<?php

namespace Domain\Geolocation\Actions;

use Domain\Geolocation\DTO\CreateGeolocationDTO;
use Domain\Geolocation\Models\Geolocation;

class CreateGeolocationAction
{
    public function execute(CreateGeolocationDTO $data): Geolocation
    {
        return Geolocation::create([
            'uuid' => $data->uuid,
            'location' => $data->location,
        ]);
    }
}
