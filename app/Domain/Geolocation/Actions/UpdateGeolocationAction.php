<?php

namespace Domain\Geolocation\Actions;

use Domain\Geolocation\DTO\UpdateGeolocationDTO;
use Domain\Geolocation\Models\Geolocation;

class UpdateGeolocationAction
{
    public function execute(UpdateGeolocationDTO $data): Geolocation
    {
        return tap($data->geolocation)->update(['location' => $data->location]);
    }
}
