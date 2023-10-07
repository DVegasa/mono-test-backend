<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    public static int $userCount = 60;

    public function run(): void
    {
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < self::$userCount; $i++) {
            DB::table('clients')->insert([
                'name' => $faker->name(),
                'sex' => $faker->boolean(),
                'phone' => $faker->e164PhoneNumber(),
                'address' => $faker->boolean(60) ? $faker->address() : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
