<?php

namespace Domain\Geolocation\Casts;

use DB;
use Domain\Geolocation\Models\Point;
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
    public function get($model, string $key, $value, array $attributes): Point
    {
        $point = $model->newQuery()
            ->getQuery()
            ->first(DB::raw("ST_AsText(ST_GeomFromEWKT('{$value}')) as point"))
            ->point;

        preg_match('#^\S+\((?<lat>\d+(?:\.\d+)?) (?<lon>\d+(?:\.\d+)?)\)#', $point, $coords);

        return new Point($coords['lat'], $coords['lon']);
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
