<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuccessStory;

class SuccessStorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuccessStory::truncate();

        SuccessStory::create([
            'male_name' => 'Vijay',
            'female_name' => 'Ananya',
            'married_date' => '2023-12-22',
            'description' => 'The family-assisted feature was a blessing. Our parents were very comfortable with the process and we found our perfect match.',
            'image' => 'story_2.png'
        ]);

        SuccessStory::create([
            'male_name' => 'Karthik',
            'female_name' => 'Shalini',
            'married_date' => '2023-09-15',
            'description' => 'We found each other through this platform within 3 months. The verified profiles made it easy to trust and connect.',
            'image' => 'story_1.png'
        ]);

        SuccessStory::create([
            'male_name' => 'Arun',
            'female_name' => 'Meera',
            'married_date' => '2023-05-18',
            'description' => 'A wonderful journey that started here. We are forever grateful for the filters that helped us find each other based on our shared values.',
            'image' => 'story_3.png'
        ]);
    }
}
