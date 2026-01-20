<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Thing;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thing>
 */
class ThingFactory extends Factory
{
    protected $model = Thing::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Молоток', 'Дрель', 'Термос', 'Кофеварка', 'Пылесос',
            'Ножницы', 'Линейка', 'Фонарик', 'Карандаш', 'Ручка',
        ];

        $descriptions = [
            'Инструмент для забивания гвоздей',
            'Электрический инструмент для сверления',
            'Сосуд для сохранения температуры напитков',
            'Устройство для приготовления кофе',
            'Бытовой прибор для уборки пыли',
            'Ножницы для бумаги и ткани',
            'Измерительный инструмент длиной 30 см',
            'Портативный источник света',
            'Графитовый карандаш 2B',
            'Шариковая ручка с синими чернилами',
        ];

        return [
            'name' => $this->faker->randomElement($names),
            'description' => [
                'variants' => $descriptions,
                'current' => $this->faker->randomElement($descriptions)
            ],
            'wrnt' => $this->faker->date('Y-m-d', '+1 year'),
            'master_id' => User::inRandomOrder()->first()->id,
            'amount' => $this->faker->numberBetween(1, 100)
        ];
    }
}
