<?php

namespace Domain\Geolocation\Models {

    /**
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery query()
     * @mixin \IdeHelper\Domain\Geolocation\Models\GeolocationQuery
     */
    class Geolocation {
        public function initiatedMeets(): \IdeHelper\Domain\Geolocation\Models\Geolocation\InitiatedMeets {}

        public function receivedMeets(): \IdeHelper\Domain\Geolocation\Models\Geolocation\ReceivedMeets {}
    }
}

namespace Domain\Meet\Models {

    /**
     * @method \IdeHelper\Domain\Meet\Models\MeetQuery query()
     * @mixin \IdeHelper\Domain\Meet\Models\MeetQuery
     */
    class Meet {
        public function from(): \IdeHelper\Domain\Meet\Models\Meet\From {}

        public function to(): \IdeHelper\Domain\Meet\Models\Meet\To {}
    }
}

namespace Domain\Token\Models {

    /**
     * @method \IdeHelper\Domain\Token\Models\TokenQuery query()
     * @mixin \IdeHelper\Domain\Token\Models\TokenQuery
     */
    class Token {}
}

namespace IdeHelper\Domain\Geolocation\Models {

    /**
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery whereUuid(string $value)
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery whereLocation(\Domain\Geolocation\Models\Point|string $value)
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery whereCreatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery whereUpdatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery newerThan(int $time)
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery nearTo($point, int $distance)
     * @method \IdeHelper\Domain\Geolocation\Models\GeolocationQuery farFrom($point, int $distance)
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
     * @mixin \Domain\Meet\Models\Meet
     */
    class InitiatedMeets extends \Illuminate\Database\Eloquent\Relations\HasMany {}

    /**
     * @mixin \Domain\Meet\Models\Meet
     */
    class ReceivedMeets extends \Illuminate\Database\Eloquent\Relations\HasMany {}
}

namespace IdeHelper\Domain\Meet\Models {

    /**
     * @method \IdeHelper\Domain\Meet\Models\MeetQuery whereId(int|string $value)
     * @method \IdeHelper\Domain\Meet\Models\MeetQuery whereGeolocationFrom(string $value)
     * @method \IdeHelper\Domain\Meet\Models\MeetQuery whereGeolocationTo(string $value)
     * @method \IdeHelper\Domain\Meet\Models\MeetQuery whereCreatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \IdeHelper\Domain\Meet\Models\MeetQuery whereUpdatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \Domain\Meet\Models\Meet create(array $attributes = [])
     * @method \Domain\Meet\Collections\MeetCollection|\Domain\Meet\Models\Meet|null find($id, array $columns = ['*'])
     * @method \Domain\Meet\Collections\MeetCollection findMany($id, array $columns = ['*'])
     * @method \Domain\Meet\Collections\MeetCollection|\Domain\Meet\Models\Meet findOrFail($id, array $columns = ['*'])
     * @method \Domain\Meet\Models\Meet findOrNew($id, array $columns = ['*'])
     * @method \Domain\Meet\Models\Meet|null first(array|string $columns = ['*'])
     * @method \Domain\Meet\Models\Meet firstOrCreate(array $attributes, array $values = [])
     * @method \Domain\Meet\Models\Meet firstOrFail(array $columns = ['*'])
     * @method \Domain\Meet\Models\Meet firstOrNew(array $attributes = [], array $values = [])
     * @method \Domain\Meet\Models\Meet forceCreate(array $attributes = [])
     * @method \Domain\Meet\Collections\MeetCollection get(array|string $columns = ['*'])
     * @method \Domain\Meet\Models\Meet getModel()
     * @method \Domain\Meet\Collections\MeetCollection getModels(array|string $columns = ['*'])
     * @method \Domain\Meet\Models\Meet newModelInstance(array $attributes = [])
     * @method \Domain\Meet\Models\Meet updateOrCreate(array $attributes, array $values = [])
     * @template TModelClass
     * @extends \Illuminate\Database\Eloquent\Builder<\Domain\Meet\Models\Meet>
     */
    class MeetQuery extends \Illuminate\Database\Eloquent\Builder {}
}

namespace IdeHelper\Domain\Meet\Models\Meet {

    /**
     * @mixin \Domain\Geolocation\Models\Geolocation
     */
    class From extends \Illuminate\Database\Eloquent\Relations\BelongsTo {}

    /**
     * @mixin \Domain\Geolocation\Models\Geolocation
     */
    class To extends \Illuminate\Database\Eloquent\Relations\BelongsTo {}
}

namespace IdeHelper\Domain\Token\Models {

    /**
     * @method \IdeHelper\Domain\Token\Models\TokenQuery whereId(int|string $value)
     * @method \IdeHelper\Domain\Token\Models\TokenQuery whereValue(string $value)
     * @method \IdeHelper\Domain\Token\Models\TokenQuery whereRandomValue(string $value)
     * @method \IdeHelper\Domain\Token\Models\TokenQuery whereCreatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \IdeHelper\Domain\Token\Models\TokenQuery whereUpdatedAt(\Illuminate\Support\Carbon|string $value)
     * @method \Domain\Token\Models\Token create(array $attributes = [])
     * @method \Illuminate\Database\Eloquent\Collection|\Domain\Token\Models\Token|null find($id, array $columns = ['*'])
     * @method \Illuminate\Database\Eloquent\Collection findMany($id, array $columns = ['*'])
     * @method \Illuminate\Database\Eloquent\Collection|\Domain\Token\Models\Token findOrFail($id, array $columns = ['*'])
     * @method \Domain\Token\Models\Token findOrNew($id, array $columns = ['*'])
     * @method \Domain\Token\Models\Token|null first(array|string $columns = ['*'])
     * @method \Domain\Token\Models\Token firstOrCreate(array $attributes, array $values = [])
     * @method \Domain\Token\Models\Token firstOrFail(array $columns = ['*'])
     * @method \Domain\Token\Models\Token firstOrNew(array $attributes = [], array $values = [])
     * @method \Domain\Token\Models\Token forceCreate(array $attributes = [])
     * @method \Illuminate\Database\Eloquent\Collection get(array|string $columns = ['*'])
     * @method \Domain\Token\Models\Token getModel()
     * @method \Illuminate\Database\Eloquent\Collection getModels(array|string $columns = ['*'])
     * @method \Domain\Token\Models\Token newModelInstance(array $attributes = [])
     * @method \Domain\Token\Models\Token updateOrCreate(array $attributes, array $values = [])
     * @template TModelClass
     * @extends \Illuminate\Database\Eloquent\Builder<\Domain\Token\Models\Token>
     */
    class TokenQuery extends \Illuminate\Database\Eloquent\Builder {}
}
