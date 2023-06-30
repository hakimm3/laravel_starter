<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key' => 'brand_name',
                'value' => 'PT. Era Kualitas Informasi',
            ],
            [
                'key'   => 'brand_phone',
                'value' => '09238383732'
            ],
            [
                'key'   => 'brand_address',
                'value' => 'Jl. Jalan No. 1, Jakarta Selatan'
            ],
            [
                'key'   => 'site_name',
                'value' => 'Starter Admin LTE'
            ],
            [
                'key'   => 'site_description',
                'value' => 'Starter Admin LTE'
            ],
            [
                'key'   => 'logo_small',
                'value' => ''
            ],
            [
                'key'   => 'logo_large',
                'value' => ''
            ],
            [
                'key'   => 'dark_mode',
                'value' => 0
            ],
            [
                'key'   => 'color_sidebar',
                'value' => '#3a45c4'
            ],
            [
                'key'   => 'color_sidebar_brand',
                'value' => '#3a45c4'
            ]
        ];

        foreach ($data as $key => $value) {
            \App\Models\Setting::create($value);
        }
    }
}
