<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $module = [
            'permission',
            'role',
            'user',
            'department',
        ];

        $action = [
            'create',
            'read',
            'update',
            'delete',
        ];

        foreach ($module as $key => $value) {
            foreach ($action as $k => $v) {
                Permission::create([
                    'name' => $v . ' ' . $value,
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}
