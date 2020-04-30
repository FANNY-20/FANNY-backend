<?php

namespace Domain\Geolocation\Casts;

use DB;
use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Location;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Query\Expression;

class LocationCast implements CastsAttributes
{
    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $value
     * @param array<string, mixed> $attributes
     */
    public function get($model, string $key, $value, array $attributes): Location
    {
        $location = Geolocation::query()
            ->select(DB::raw(
                "ST_AsText(ST_GeomFromEWKT('{$value}')) as point"
            ))->first();

        preg_match('#^\S+\((?<lat>\d+(?:\.\d+)?) (?<lon>\d+(?:\.\d+)?)\)#', $location['point'], $coords);

        return new Location($coords['lat'], $coords['lon']);
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $value
     * @param array<string, mixed> $attributes
     */
    public function set($model, string $key, $value, array $attributes): Expression
    {
        return DB::raw("ST_GeomFromText('POINT({$value->latitude} {$value->longitude})')");
    }
}
