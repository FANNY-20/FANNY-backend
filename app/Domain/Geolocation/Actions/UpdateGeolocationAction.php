<?php

namespace Domain\Geolocation\Actions;

use Domain\Geolocation\DTO\UpdateGeolocationDTO;
use Domain\Geolocation\Models\Geolocation;

class UpdateGeolocationAction
{
    public function execute(UpdateGeolocationDTO $data): Geolocation
    {
        $data->geolocation->location = $data->location;
        $data->geolocation->save();

        return $data->geolocation;
    }
}
