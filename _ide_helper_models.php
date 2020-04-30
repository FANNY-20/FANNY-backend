<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Domain\Geolocation\Models{
/**
 * Domain\Geolocation\Models\Geolocation
 *
 * @property string $uuid
 * @property \Domain\Geolocation\Casts\LocationCast $location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Geolocation\Models\Geolocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Geolocation\Models\Geolocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Geolocation\Models\Geolocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Geolocation\Models\Geolocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Geolocation\Models\Geolocation whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Geolocation\Models\Geolocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Domain\Geolocation\Models\Geolocation whereUuid($value)
 */
	class Geolocation extends \Eloquent {}
}

