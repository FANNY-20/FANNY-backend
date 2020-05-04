<?php

namespace Domain\Meet;

use Domain\Geolocation\Models\Geolocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
