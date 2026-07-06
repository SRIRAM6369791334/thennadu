<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterInterest;

class MatchmakingMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = [
            'Cooking', 'Travel', 'Reading', 'Music', 'Fitness', 
            'Photography', 'Gardening', 'Swimming', 'Painting', 'Dance'
        ];

        foreach ($interests as $name) {
            MasterInterest::firstOrCreate(['name' => $name]);
        }
    }
}
