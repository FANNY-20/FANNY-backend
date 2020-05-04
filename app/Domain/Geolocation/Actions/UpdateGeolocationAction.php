<?php

namespace Domain\Geolocation\Actions;

use Domain\Geolocation\DTO\SaveGeolocationDTO;
use Domain\Geolocation\Models\Geolocation;

class UpdateGeolocationAction
{
    public function execute(SaveGeolocationDTO $data): Geolocation
    {
        $data->geolocation->location = $data->location;
        $data->geolocation->save();

        return $data->geolocation;
    }
}
