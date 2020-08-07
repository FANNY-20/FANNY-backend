<?php

namespace Database\Factories\Token;

use Domain\Token\Models\Token;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method \Domain\Token\Models\Token createOne($attributes = [])
 * @method \Domain\Token\Models\Token|\Illuminate\Database\Eloquent\Collection create($attributes = [], \Illuminate\Database\Eloquent\Model|null $parent = null)
 * @method \Domain\Token\Models\Token makeOne($attributes = [])
 * @method \Domain\Token\Models\Token|\Illuminate\Database\Eloquent\Collection make($attributes = [], \Illuminate\Database\Eloquent\Model|null $parent = null)
 * @method \Domain\Token\Models\Token newModel(array $attributes = [])
 */
class TokenFactory extends Factory
{
    /** @var string */
    protected $model = Token::class;

    /**
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'value' => $this->faker->unique()->sha256,
            'random_value' => $this->faker->unique()->sha256,
        ];
    }

    public function updatedAt($updatedAt): self
    {
        return $this->state(['updated_at' => $updatedAt]);
    }
}
