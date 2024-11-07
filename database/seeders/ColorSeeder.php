<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $colors = [
            ['name' => 'White', 'value' => '#FFFFFF'],
            ['name' => 'Black', 'value' => '#000000'],
            ['name' => 'Navy', 'value' => '#1E3A8A'],
            ['name' => 'Red', 'value' => '#DC2626'],
            ['name' => 'Green', 'value' => '#059669'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
