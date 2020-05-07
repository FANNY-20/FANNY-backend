<?php

namespace Domain\Meet\Actions;

use Domain\Geolocation\Models\Geolocation;

class CreateMeetAction
{
    public function execute(Geolocation $geolocation, string $uuid): void
    {
        $geolocation->initiatedMeets()->create([
            'geolocation_to' => $uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $geolocation->receivedMeets()->create([
            'geolocation_from' => $uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
