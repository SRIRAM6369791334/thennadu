<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::create([
            'image' => 'images/banners/banner_1.png',
            'title' => 'Find Your {Perfect} Soulmate',
            'subtitle' => 'The Most Trusted Tamil Matrimony platform with verified profiles and cultural values.',
            'status' => 1,
            'order' => 1
        ]);

        Banner::create([
            'image' => 'images/banners/banner_2.png',
            'title' => 'Trust, {Culture} & Tradition',
            'subtitle' => 'Helping Tamil families connect globally for generations with safety and security.',
            'status' => 1,
            'order' => 2
        ]);
    }
}
