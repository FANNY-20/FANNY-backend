<?php

namespace Domain\Geolocation\Models;

use Domain\Geolocation\Casts\LocationCast;
use Domain\Meet\Meet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $uuid
 * @property \Domain\Geolocation\Models\Point $location
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<\Domain\Meet\Meet> $meets
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
}
