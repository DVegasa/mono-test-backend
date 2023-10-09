<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('ru_RU');

        $brands = ['KIA', 'Лада', 'УАЗ', 'Mercedes'];

        for ($i = 0; $i < ClientsSeeder::$userCount * 3; $i++) {
            DB::table('cars')->insert([
                'brand' => $faker->randomElement($brands),
                'model' => $faker->word(),
                'color' => $faker->colorName(),
                'plate' => $this->randomPlate(),
                'is_parked' => $faker->boolean(30),
                'owner_id' => $faker->numberBetween(1, ClientsSeeder::$userCount),
                'created_at' => Carbon::yesterday()->subMinutes(10000 - $i),
                'updated_at' => Carbon::yesterday()->subMinutes(10000 - $i),
            ]);
        }
    }

    /**
     * @return string A123AA34
     */
    private function randomPlate(): string
    {
        $letters = ['A', 'B', 'E', 'K', 'M', 'H', 'O', 'P', 'C', 'T', 'Y', 'X'];
        $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

        return ''
            . fake()->randomElement($letters)
            . fake()->randomElement($numbers)
            . fake()->randomElement($numbers)
            . fake()->randomElement($numbers)
            . fake()->randomElement($letters)
            . fake()->randomElement($letters)
            . fake()->randomElement([34, 134, 777]);
    }
}
