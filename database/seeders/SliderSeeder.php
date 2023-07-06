<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for($i = 0; $i<10; $i++){
            $slider = \App\Models\Slider::create([
                'title' => $faker->sentence(3),
                'description' => $faker->sentence(10),
                'image' => 'slider-' . $i . '.jpg',
            ]);
        }
    }
}
