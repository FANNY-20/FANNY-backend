<?php

namespace Domain\Meet\Models;

use Domain\Geolocation\Models\Geolocation;
use Domain\Meet\Collections\MeetCollection;
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
 * @method static \Domain\Meet\Collections\MeetCollection all(array|mixed $columns = ['*'])
 */
class Meet extends Model
{
    /**
     * @param array<\Domain\Meet\Models\Meet> $models
     */
    public function newCollection(array $models = []): MeetCollection
    {
        return new MeetCollection($models);
    }

    public function from(): BelongsTo
    {
        return $this->belongsTo(Geolocation::class, 'geolocation_from');
    }

    public function to(): BelongsTo
    {
        return $this->belongsTo(Geolocation::class, 'geolocation_to');
    }
}
