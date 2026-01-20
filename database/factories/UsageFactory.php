<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usage;
use App\Models\Thing;
use App\Models\Place;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UsageFactory extends Factory
{
    protected $model = Usage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'thing_id' => Thing::factory(),
            'place_id' => Place::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'amount' => $this->faker->numberBetween(1, 10)
        ];
    }
}
