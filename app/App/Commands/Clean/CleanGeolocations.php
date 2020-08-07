<?php

namespace App\Commands\Clean;

use Domain\Geolocation\Models\Geolocation;
use Illuminate\Console\Command;

class CleanGeolocations extends Command
{
    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $signature = 'stop-covid:clean-geolocations';

    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $description = 'Delete geolocations after existing x minutes';

    public function handle(): void
    {
        $date = now()->subMinutes(config('stop-covid.clean.geolocations'));

        Geolocation::where('updated_at', '<', $date)
            ->delete();
    }
}
