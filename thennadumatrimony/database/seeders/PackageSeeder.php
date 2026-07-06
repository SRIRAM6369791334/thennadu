<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('packages')->insert([
            'package_name' => 'Platinum Plus',
            'package_price' => '4999',
            'no_of_videos' => '1',
            'no_of_images' => '20',
            'specification_3' => 'Yes', // Chat
            'specification_4' => 'Yes', // Highlights
            'specification_5' => 'Yes', // Advanced Search
            'specification_6' => 'Yes', // Direct Call
            'specification_7' => 'Unlimited',
            'specification_8' => 'Premium Support',
            'specification_9' => 'Verified Badge',
            'specification_10' => 'Top Priority',
            'package_status' => 1,
            'validity' => 180, // 6 months
            'noofmblno' => 100, // 100 contact views
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
