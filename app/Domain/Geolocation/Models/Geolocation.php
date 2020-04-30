<?php

namespace Domain\Geolocation\Models;

use Domain\Geolocation\Casts\LocationCast;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $uuid
 * @property \Domain\Geolocation\Models\Point $location
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Geolocation extends Model
{
    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $primaryKey = 'uuid';

    /** @var array<string,string> */
    protected $casts = [
        'location' => LocationCast::class,
    ];
}
