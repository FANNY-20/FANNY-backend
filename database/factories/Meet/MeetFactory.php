<?php

namespace Database\Factories\Meet;

use Database\Factories\Geolocation\GeolocationFactory;
use Domain\Geolocation\Models\Geolocation;
use Domain\Meet\Models\Meet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method \Domain\Meet\Models\Meet createOne($attributes = [])
 * @method \Domain\Meet\Models\Meet|\Domain\Meet\Collections\MeetCollection create($attributes = [], \Illuminate\Database\Eloquent\Model|null $parent = null)
 * @method \Domain\Meet\Models\Meet makeOne($attributes = [])
 * @method \Domain\Meet\Models\Meet|\Domain\Meet\Collections\MeetCollection make($attributes = [], \Illuminate\Database\Eloquent\Model|null $parent = null)
 * @method \Domain\Meet\Models\Meet newModel(array $attributes = [])
 * @method \Database\Factories\Meet\MeetFactory forFrom($attributes = [])
 * @method \Database\Factories\Meet\MeetFactory forTo($attributes = [])
 */
class MeetFactory extends Factory
{
    /** @var string */
    protected $model = Meet::class;

    /**
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'geolocation_from' => GeolocationFactory::new(),
            'geolocation_to' => GeolocationFactory::new(),
        ];
    }

    public function updatedAt($updatedAt): self
    {
        return $this->state(['updated_at' => $updatedAt]);
    }

    public function geolocationFrom(Geolocation $geolocation): self
    {
        return $this->state(['geolocation_from' => $geolocation]);
    }
}
