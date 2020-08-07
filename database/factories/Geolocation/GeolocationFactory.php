<?php

namespace Database\Factories\Geolocation;

use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method \Domain\Geolocation\Models\Geolocation createOne($attributes = [])
 * @method \Domain\Geolocation\Models\Geolocation|\Illuminate\Database\Eloquent\Collection create($attributes = [], \Illuminate\Database\Eloquent\Model|null $parent = null)
 * @method \Domain\Geolocation\Models\Geolocation makeOne($attributes = [])
 * @method \Domain\Geolocation\Models\Geolocation|\Illuminate\Database\Eloquent\Collection make($attributes = [], \Illuminate\Database\Eloquent\Model|null $parent = null)
 * @method \Domain\Geolocation\Models\Geolocation newModel(array $attributes = [])
 * @method \Database\Factories\Geolocation\GeolocationFactory hasInitiatedMeets($count = 1, $attributes = [])
 * @method \Database\Factories\Geolocation\GeolocationFactory hasReceivedMeets($count = 1, $attributes = [])
 */
class GeolocationFactory extends Factory
{
    /** @var string */
    protected $model = Geolocation::class;

    /**
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->unique()->sha256,
            'location' => new Point($this->faker->latitude, $this->faker->longitude),
        ];
    }

    public function uuid(string $uuid): self
    {
        return $this->state(['uuid' => $uuid]);
    }

    public function location(Point $point): self
    {
        return $this->state(['location' => $point]);
    }

    public function updatedAt($updatedAt): self
    {
        return $this->state(['updated_at' => $updatedAt]);
    }
}
