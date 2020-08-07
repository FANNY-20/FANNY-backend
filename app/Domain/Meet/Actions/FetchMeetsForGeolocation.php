<?php

namespace Domain\Meet\Actions;

use Domain\Geolocation\Models\Geolocation;
use Domain\Meet\Collections\MeetCollection;
use Domain\Meet\Models\Meet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FetchMeetsForGeolocation
{
    private CreateMeetAction $createMeet;

    private UpdateMeetAction $updateMeet;

    private CleanOlderMeetsAction $cleanOlderMeets;

    private Geolocation $geolocation;

    public function __construct(
        CreateMeetAction $createMeet,
        UpdateMeetAction $updateMeet,
        CleanOlderMeetsAction $cleanOlderMeets
    ) {
        $this->createMeet = $createMeet;
        $this->updateMeet = $updateMeet;
        $this->cleanOlderMeets = $cleanOlderMeets;
    }

    public function execute(Geolocation $geolocation): Collection
    {
        $this->geolocation = $geolocation;

        $nearsUuids = $this->fetchNearGeolocations();

        $this->cleanOlderMeets->execute($geolocation, $nearsUuids);

        if (count($nearsUuids) <= 0) {
            return collect();
        }

        $meets = $this->fetchMeets($nearsUuids);

        $this->createMeets($meets, $nearsUuids);

        $matchingMeets = $meets->olderThan(config('stop-covid.geolocation.time'));

        $this->updateMeets($matchingMeets);

        return $matchingMeets->filter(fn (Meet $meet): bool => $meet->geolocation_to !== $this->geolocation->uuid);
    }

    /**
     * @param array<string> $nearsUuids
     */
    private function fetchMeets(array $nearsUuids): MeetCollection
    {
        return Meet::where(function ($query) use ($nearsUuids): Builder {
            /** @var \Illuminate\Database\Eloquent\Builder|\Domain\Meet\Models\Meet $query */
            return $query->whereGeolocationFrom($this->geolocation->uuid)
                ->whereIn('geolocation_to', $nearsUuids);
        })->orWhere(function ($query) use ($nearsUuids): Builder {
            /** @var \Illuminate\Database\Eloquent\Builder|\Domain\Meet\Models\Meet $query */
            return $query->whereGeolocationTo($this->geolocation->uuid)
                ->whereIn('geolocation_from', $nearsUuids);
        })->get();
    }

    /**
     * @param array<string> $nearsUuids
     */
    private function createMeets(MeetCollection $meets, array $nearsUuids): void
    {
        $meetsToCreate = collect($nearsUuids)
            ->diff($meets->geolocations());

        $meetsToCreate->each(function (string $uuid): void {
            $this->createMeet->execute($this->geolocation, $uuid);
        });
    }

    private function updateMeets(Collection $meets): void
    {
        $meets
            ->filter(function (Meet $meet): bool {
                return $meet->geolocation_from === $this->geolocation->uuid;
            })
            ->each(function (Meet $meet): void {
                $this->updateMeet->execute($meet);
            });
    }

    /**
     * @return array<string>
     */
    private function fetchNearGeolocations(): array
    {
        return Geolocation::select('uuid')
            ->where('uuid', '!=', $this->geolocation->uuid)
            ->nearTo($this->geolocation->location, config('stop-covid.geolocation.distance'))
            ->newerThan(10)
            ->get()
            ->pluck('uuid')
            ->toArray();
    }
}
