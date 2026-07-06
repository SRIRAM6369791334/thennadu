<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuccessStorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SuccessStory::create([
            'male_name' => 'Vijay',
            'female_name' => 'Ananya',
            'married_date' => 'Dec 22, 2023',
            'description' => '"The family-assisted feature was a blessing. Our parents were very comfortable with the process and we found our perfect match."',
            'image' => null, // No image provided by user yet
        ]);
    }
}
