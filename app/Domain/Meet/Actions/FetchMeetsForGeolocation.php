<?php

namespace Domain\Meet\Actions;

use Domain\Geolocation\Models\Geolocation;
use Illuminate\Support\Collection;

class FetchMeetsForGeolocation
{
    private UpdateMeetAction $updateMeet;

    public function __construct(UpdateMeetAction $updateMeet)
    {
        $this->updateMeet = $updateMeet;
    }

    public function execute(Geolocation $geolocation): Collection
    {
        $nearsId = $this->fetchNearGeolocations($geolocation);

        if (count($nearsId) <= 0) {
            return collect();
        }

        $meets = $geolocation->meets()
            ->whereIn('geolocation_to', $nearsId)
            ->atLeast(config('stop-covid.geolocation.time'))
            ->get();

        if ($meets->isEmpty()) {
            return collect();
        }

        foreach ($nearsId as $nearId) {
            $this->updateMeet->execute($geolocation->uuid, $nearId);
        }

        return $meets;
    }

    /**
     * @return array<string>
     */
    private function fetchNearGeolocations(Geolocation $geolocation): array
    {
        return Geolocation::select('uuid')
            ->where('uuid', '!=', $geolocation->uuid)
            ->nearTo($geolocation->location, config('stop-covid.geolocation.distance'))
            ->get()
            ->pluck('uuid')
            ->toArray();
    }
}
