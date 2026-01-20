<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Jenna',
            'email' => 'ivan.avilov.0606@mail.ru',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Чапик',
            'email' => 'mariahippi919@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user'
        ]);

        $this->call([
            PlaceSeeder::class,
            UsageSeeder::class
        ]);
    }
}
