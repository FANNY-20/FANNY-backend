<?php

namespace Domain\Geolocation\Models {

    /**
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery query()
     * @mixin \IdeHelper\Domain\Geolocation\Models\GeolocationQuery
     */
    class Geolocation {}
}

namespace IdeHelper\Domain\Geolocation\Models {

    /**
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery whereUuid(string $value)
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery whereLocation(mixed|string $value)
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery whereCreatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery whereUpdatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \Domain\Geolocation\Models\Geolocation create(array $attributes = [])
     * @method \Illuminate\Database\Eloquent\Collection|\Domain\Geolocation\Models\Geolocation|null find($id, array $columns = ['*'])
     * @method \Illuminate\Database\Eloquent\Collection findMany($id, array $columns = ['*'])
     * @method \Illuminate\Database\Eloquent\Collection|\Domain\Geolocation\Models\Geolocation findOrFail($id, array $columns = ['*'])
     * @method \Domain\Geolocation\Models\Geolocation findOrNew($id, array $columns = ['*'])
     * @method \Domain\Geolocation\Models\Geolocation|null first(array|string $columns = ['*'])
     * @method \Domain\Geolocation\Models\Geolocation firstOrCreate(array $attributes, array $values = [])
     * @method \Domain\Geolocation\Models\Geolocation firstOrFail(array $columns = ['*'])
     * @method \Domain\Geolocation\Models\Geolocation firstOrNew(array $attributes = [], array $values = [])
     * @method \Domain\Geolocation\Models\Geolocation forceCreate(array $attributes = [])
     * @method \Illuminate\Database\Eloquent\Collection get(array|string $columns = ['*'])
     * @method \Domain\Geolocation\Models\Geolocation getModel()
     * @method \Illuminate\Database\Eloquent\Collection getModels(array|string $columns = ['*'])
     * @method \Domain\Geolocation\Models\Geolocation newModelInstance(array $attributes = [])
     * @method \Domain\Geolocation\Models\Geolocation updateOrCreate(array $attributes, array $values = [])
     * @template TModelClass
     * @extends \Illuminate\Database\Eloquent\Builder<\Domain\Geolocation\Models\Geolocation>
     */
    class GeolocationQuery extends \Illuminate\Database\Eloquent\Builder {}
}
