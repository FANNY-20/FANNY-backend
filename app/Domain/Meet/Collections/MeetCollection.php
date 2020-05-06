<?php

namespace Domain\Meet\Collections;

use Domain\Meet\Models\Meet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class MeetCollection extends Collection
{
    /**
     * @return array<string>
     */
    public function geolocations(): array
    {
        return array_merge(
            $this->pluck('geolocation_from')->toArray(),
            $this->pluck('geolocation_to')->toArray()
        );
    }

    public function olderThan(int $time): self
    {
        return $this->filter(static function (Meet $meet) use ($time) {
            return $meet->updated_at < Carbon::now()->subSeconds($time);
        });
    }
}
