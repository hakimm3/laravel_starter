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
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
            ]
        ];

        foreach ($data as $key => $value) {
            $user = \App\Models\User::create($value);
            $user->syncRoles('Super User');
        }
    }
}
