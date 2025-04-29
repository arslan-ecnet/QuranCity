<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('themes')->insert([
            [
                'id' => 1,
                'name' => 'JAHANNAM',
                'theme_color' => '#000000',
                'theme_image' => null,
            ],
            [
                'id' => 2,
                'name' => 'ALLAH TAWHEED',
                'theme_color' => '#ffffff',
                'theme_image' => null,
            ],
            [
                'id' => 3,
                'name' => 'REFLECTION',
                'theme_color' => '#05cdff',
                'theme_image' => null,
            ],
            [
                'id' => 4,
                'name' => 'ETHIC , LAWS , DUAS',
                'theme_color' => '#6ab46b',
                'theme_image' => null,
            ],
            [
                'id' => 5,
                'name' => 'RISALA/MESSAGE & MESSENGERS',
                'theme_color' => '#eeff00',
                'theme_image' => null,
            ],
            [
                'id' => 6,
                'name' => 'WARNINGS',
                'theme_color' => '#8c0303',
                'theme_image' => null,
            ],
            [
                'id' => 7,
                'name' => 'JANNA',
                'theme_color' => '#2acb3c',
                'theme_image' => null,
            ],
            [
                'id' => 8,
                'name' => 'HISTORICAL EVENTS',
                'theme_color' => '#fcfdba',
                'theme_image' => null,
            ],
        ]);
    }
}
