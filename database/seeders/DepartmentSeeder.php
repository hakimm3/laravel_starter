<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10000; $i++) {
            \App\Models\Department::create([
                'name' => $faker->name,
                'code' => $faker->randomNumber(5) . $i,
                'description' => $faker->sentence(),
                'deleted_at' => rand(0, 1) ? now() : null,
            ]);
        }
    }
}
