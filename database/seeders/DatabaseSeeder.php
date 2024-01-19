<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Rent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $cpfsValidos = ["610.963.260-00","708.632.230-01","437.515.730-54","922.438.420-09","348.756.520-03","765.944.270-83","380.404.610-06"];

        foreach($cpfsValidos as $cpf)
        {
            \App\Models\User::factory()->create([
                'name' => fake()->name(),
                'cpf' => $cpf,
            ]);
        }

        Book::factory(10)->create();

       
    }
}
