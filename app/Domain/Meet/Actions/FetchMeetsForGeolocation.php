<?php

namespace Domain\Meet\Actions;

use Domain\Geolocation\Models\Geolocation;
use Domain\Meet\Models\Meet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class FetchMeetsForGeolocation
{
    private UpdateMeetAction $updateMeet;

    private CleanOlderMeetsAction $cleanOlderMeets;

    private Geolocation $geolocation;

    public function __construct(UpdateMeetAction $updateMeet, CleanOlderMeetsAction $cleanOlderMeets)
    {
        $this->updateMeet = $updateMeet;
        $this->cleanOlderMeets = $cleanOlderMeets;
    }

    public function execute(Geolocation $geolocation): Collection
    {
        $this->geolocation = $geolocation;

        // liste des uuids dans le périmètre de 15m
        $nearsUuids = $this->fetchNearGeolocations();

        $this->cleanOlderMeets->execute($geolocation, $nearsUuids->pluck('uuid')->toArray());

        if (count($nearsUuids) <= 0) {
            return collect();
        }

        // liste des rencontres de plus de 30 secondes
        $meets = $this->fetchMeets($nearsUuids->pluck('uuid')->toArray());

        $meetsToCreate = $nearsUuids->pluck('uuid')->diff($meets->pluck('geolocation_to')->toArray())
            ->values();

        foreach ($meetsToCreate as $meet) {
            $geolocation->meets()->create([
                'geolocation_to' => $meet,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $matchingMeets = $meets->filter(static function (Meet $meet) {
            return $meet->updated_at < Carbon::now()->subSeconds(config('stop-covid.geolocation.time'));
        });

        /** @var \Domain\Meet\Models\Meet $meet */
        foreach ($matchingMeets as $meet) {
            $meet->update([
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        //$this->saveMeets($nearsUuids);

        return $matchingMeets;
    }

    /**
     * @param array<string> $nearsUuids
     */
    private function fetchMeets(array $nearsUuids): Collection
    {
        return $this->geolocation->meets()
            ->whereIn('geolocation_to', $nearsUuids)
            //->olderThan(config('stop-covid.geolocation.time'))
            ->get();
    }

    private function saveMeets(array $uuids)
    {
        foreach ($uuids as $uuid) {
            $this->updateMeet->execute($this->geolocation->uuid, $uuid);
        }
    }

    /**
     * @return array<string>
     */
    private function fetchNearGeolocations(): Collection
    {
        return $query = Geolocation::select('uuid')
            ->where('uuid', '!=', $this->geolocation->uuid)
            ->nearTo($this->geolocation->location, config('stop-covid.geolocation.distance'))
            //->newerThan(10)
            ->get();
        /*\Log::debug("{$this->geolocation->uuid} distance de " . $query->pluck('distance'));

        return $query
            ->pluck('uuid')
            ->toArray();*/
    }
}
