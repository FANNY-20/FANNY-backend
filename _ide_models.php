<?php

namespace Domain\Geolocation\Models {

    /**
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery query()
     * @mixin \IdeHelper\Domain\Geolocation\Models\GeolocationQuery
     */
    class Geolocation {
        public function meets(): \IdeHelper\Domain\Geolocation\Models\Geolocation\Meets {}
    }
}

namespace Domain\Meet {

    /**
     * @method \IdeHelper\Domain\Meet\MeetQuery query()
     * @mixin \IdeHelper\Domain\Meet\MeetQuery
     */
    class Meet {
        public function from(): \IdeHelper\Domain\Meet\Meet\From {}

        public function to(): \IdeHelper\Domain\Meet\Meet\To {}
    }
}

namespace IdeHelper\Domain\Geolocation\Models {

    /**
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery whereUuid(string $value)
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery whereLocation(\Domain\Geolocation\Models\Point|string $value)
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

namespace IdeHelper\Domain\Geolocation\Models\Geolocation {

    /**
     * @mixin \Domain\Meet\Meet
     */
    class Meets extends \Illuminate\Database\Eloquent\Relations\HasMany {}
}

namespace IdeHelper\Domain\Meet {

    /**
     * @method \IdeHelper\Domain\Meet\MeetQuery whereId(int|string $value)
     * @method \IdeHelper\Domain\Meet\MeetQuery whereGeolocationFrom(string $value)
     * @method \IdeHelper\Domain\Meet\MeetQuery whereGeolocationTo(string $value)
     * @method \IdeHelper\Domain\Meet\MeetQuery whereCreatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \IdeHelper\Domain\Meet\MeetQuery whereUpdatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \Domain\Meet\Meet create(array $attributes = [])
     * @method \Illuminate\Database\Eloquent\Collection|\Domain\Meet\Meet|null find($id, array $columns = ['*'])
     * @method \Illuminate\Database\Eloquent\Collection findMany($id, array $columns = ['*'])
     * @method \Illuminate\Database\Eloquent\Collection|\Domain\Meet\Meet findOrFail($id, array $columns = ['*'])
     * @method \Domain\Meet\Meet findOrNew($id, array $columns = ['*'])
     * @method \Domain\Meet\Meet|null first(array|string $columns = ['*'])
     * @method \Domain\Meet\Meet firstOrCreate(array $attributes, array $values = [])
     * @method \Domain\Meet\Meet firstOrFail(array $columns = ['*'])
     * @method \Domain\Meet\Meet firstOrNew(array $attributes = [], array $values = [])
     * @method \Domain\Meet\Meet forceCreate(array $attributes = [])
     * @method \Illuminate\Database\Eloquent\Collection get(array|string $columns = ['*'])
     * @method \Domain\Meet\Meet getModel()
     * @method \Illuminate\Database\Eloquent\Collection getModels(array|string $columns = ['*'])
     * @method \Domain\Meet\Meet newModelInstance(array $attributes = [])
     * @method \Domain\Meet\Meet updateOrCreate(array $attributes, array $values = [])
     * @template TModelClass
     * @extends \Illuminate\Database\Eloquent\Builder<\Domain\Meet\Meet>
     */
    class MeetQuery extends \Illuminate\Database\Eloquent\Builder {}
}

namespace IdeHelper\Domain\Meet\Meet {

    /**
     * @mixin \Domain\Geolocation\Models\Geolocation
     */
    class From extends \Illuminate\Database\Eloquent\Relations\BelongsTo {}

    /**
     * @mixin \Domain\Geolocation\Models\Geolocation
     */
    class To extends \Illuminate\Database\Eloquent\Relations\BelongsTo {}
}
