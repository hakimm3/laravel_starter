<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [   
                'department_id' => 1,
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
            ]
        ];

        foreach ($data as $key => $value) {
            $user = \App\Models\User::create($value);
            $user->syncRoles('admin');
        }

        $faker = \Faker\Factory::create('id_ID');
        for($i = 0; $i<100; $i++){
            $user = \App\Models\User::create([
                'department_id' => $faker->numberBetween(1, 100),
                'name' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => bcrypt('password'),
            ]);
            $user->syncRoles('user');
        }
    }
}
