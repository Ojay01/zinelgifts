<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlidesTableSeeder extends Seeder
{
    public function run()
    {
        Slide::create([
            'image' => 'https://cdn.pixabay.com/photo/2024/08/26/12/29/milky-way-8999255_1280.jpg',
            'subtitle' => 'HIGH STRENGTH AND DURABLE',
            'title' => 'Buy The Best Equipment For An Excellent Surprise.',
            'button1_text' => 'VIEW MORE',
            'button1_link' => '#',
            'button2_text' => 'TO SHOP',
            'button2_link' => '#',
        ]);

        Slide::create([
            'image' => 'https://cdn.pixabay.com/photo/2023/10/07/14/24/smartwatch-8300238_1280.jpg',
            'subtitle' => 'QUALITY GUARANTEED',
            'title' => 'Discover Our Premium Selection',
            'button1_text' => 'EXPLORE',
            'button1_link' => '#',
            'button2_text' => 'SHOP NOW',
            'button2_link' => '#',
        ]);

        Slide::create([
            'image' => 'https://cdn.pixabay.com/photo/2024/07/21/10/22/vulture-8910009_1280.jpg',
            'subtitle' => 'ADVENTURE AWAITS',
            'title' => 'Gear Up for Your Next Unforgettable Journey',
            'button1_text' => 'LEARN MORE',
            'button1_link' => '#',
            'button2_text' => 'GET STARTED',
            'button2_link' => '#',
        ]);
    }
}

