<?php

namespace Domain\Meet\Actions;

use Domain\Geolocation\Models\Geolocation;
use Domain\Meet\Models\Meet;

class CleanOlderMeetsAction
{
    /**
     * @param array<string> $uuids
     */
    public function execute(Geolocation $geolocation, array $uuids): void
    {
        Meet::where('geolocation_from', $geolocation->uuid)
            ->whereNotIn('geolocation_to', $uuids)
            ->delete();
    }
}
