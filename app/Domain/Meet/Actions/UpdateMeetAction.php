<?php

namespace Domain\Meet\Actions;

use Domain\Meet\Models\Meet;

class UpdateMeetAction
{
    public function execute(string $fromUuid, string $toUuid): void
    {
        Meet::updateOrCreate([
            'geolocation_from' => $fromUuid,
            'geolocation_to' => $toUuid,
        ], [
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
