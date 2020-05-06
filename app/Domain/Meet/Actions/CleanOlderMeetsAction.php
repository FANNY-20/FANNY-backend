<?php

namespace Domain\Meet\Actions;

use Domain\Geolocation\Models\Geolocation;
use Domain\Meet\Models\Meet;
use Illuminate\Database\Eloquent\Builder;

class CleanOlderMeetsAction
{
    /**
     * @param array<string> $uuids
     */
    public function execute(Geolocation $geolocation, array $uuids): void
    {
        Meet::where(static function ($query) use ($geolocation, $uuids): Builder {
            /** @var \Illuminate\Database\Eloquent\Builder|\Domain\Meet\Models\Meet $query */
            return $query->whereGeolocationFrom($geolocation->uuid)
                ->whereNotIn('geolocation_to', $uuids);
        })->orWhere(static function ($query) use ($geolocation, $uuids): Builder {
            /** @var \Illuminate\Database\Eloquent\Builder|\Domain\Meet\Models\Meet $query */
            return $query->whereGeolocationTo($geolocation->uuid)
                ->whereNotIn('geolocation_from', $uuids);
        })->delete();
    }
}
