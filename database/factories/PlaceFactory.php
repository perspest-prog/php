<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Place;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlaceFactory extends Factory
{
    protected $model = Place::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Склад инструментов',
            'Мастерская по ремонту',
            'Рабочий цех'
        ];

        $descriptions = [
            'Хранение всех инструментов, сухое помещение',
            'Место для ремонта и обслуживания инструментов',
            'Основное место эксплуатации инструментов'
        ];

        return [
            'name' => $this->faker->randomElement($names),
            'description' => $this->faker->randomElement($descriptions),
            'repair' => $this->faker->boolean(20), // 20% шанс — место для ремонта
            'work' => $this->faker->boolean(70),   // 70% шанс — в работе
        ];
    }
}
