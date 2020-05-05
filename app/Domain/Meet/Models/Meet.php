<?php

namespace Domain\Meet\Models;

use Domain\Geolocation\Models\Geolocation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $geolocation_from
 * @property string $geolocation_to
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Domain\Geolocation\Models\Geolocation $from
 * @property-read \Domain\Geolocation\Models\Geolocation $to
 */
class Meet extends Model
{
    public function from(): BelongsTo
    {
        return $this->belongsTo(Geolocation::class, 'geolocation_from');
    }

    public function to(): BelongsTo
    {
        return $this->belongsTo(Geolocation::class, 'geolocation_to');
    }

    public function scopeOlderThan(Builder $query, int $time): Builder
    {
        return $query
            ->where('updated_at', '<', Carbon::now()->subSeconds($time));
    }
}
