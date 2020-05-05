<?php

namespace Domain\Geolocation\Models;

use Domain\Geolocation\Casts\LocationCast;
use Domain\Meet\Models\Meet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property string $uuid
 * @property \Domain\Geolocation\Models\Point $location
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<\Domain\Meet\Models\Meet> $meets
 */
class Geolocation extends Model
{
    /** @var bool
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    public $incrementing = false;

    /**
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $primaryKey = 'uuid';

    /**
     * @var array<string,string>
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $casts = [
        'location' => LocationCast::class,
    ];

    public function meets(): HasMany
    {
        return $this->hasMany(Meet::class, 'geolocation_from');
    }

    public function scopeNewerThan(Builder $query, int $time): Builder
    {
        return $query
            ->where('updated_at', '>', Carbon::now()->subMinutes($time));
    }

    /**
     * @param \Domain\Geolocation\Models\Point|array<float> $point
     */
    public function scopeNearTo(Builder $query, $point, int $distance): Builder
    {
        return $this->withDistance($query, $point, $distance, '<=');
    }

    /**
     * @param \Domain\Geolocation\Models\Point|array<float> $point
     */
    public function scopeFarFrom(Builder $query, $point, int $distance): Builder
    {
        return $this->withDistance($query, $point, $distance, '>');
    }

    /**
     * @param \Domain\Geolocation\Models\Point|array<float> $point
     */
    private function withDistance(Builder $query, $point, int $distance, string $operator): Builder
    {
        if ($point instanceof Point) {
            $point = $point->toArray();
        }

        $parameters = array_merge($point, [$distance]);

        return $query
            ->whereRaw(
                sprintf('ST_Distance(location::geography, ST_MakePoint(?,?)::geography) %s ?', $operator),
                $parameters
            );
    }
}
