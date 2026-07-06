<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\InterestRequest;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ChatDemoSeeder extends Seeder
{
    public function run(): void
    {
        $navinUser = User::where('email', 'navinbcs10@gmail.com')->first();
        if (!$navinUser) return;

        // Using withoutEvents to avoid the broken ProfileObserver which tries to sync missing columns
        Profile::withoutEvents(function() use ($navinUser) {
            // 1. Create a Matching Female User (System user for interest mapping)
            $femaleUser = User::updateOrCreate(
                ['email' => 'priya.demo@gmail.com'],
                [
                    'name' => 'Priya Sharma',
                    'password' => Hash::make('password'),
                    'gender' => 'Female',
                    'mblno' => '9888877771',
                    'user_ID' => 'DEMO123456',
                    'role' => '4',
                    'status' => 1,
                    'dob' => '1995-03-21',
                    'religion' => '1',
                    'caste' => '1',
                    'marital_status' => '1',
                    'mother_tongue' => '1',
                    'district' => 'Chennai'
                ]
            );

            // 2. Create the Profile (Registers table mapping for members)
            $femaleProfile = Profile::updateOrCreate(
                ['email_id' => 'priya.demo@gmail.com'],
                [
                    'varan_id' => 'DEMO123456',
                    'Name' => 'Priya Sharma',
                    'Gender' => '2', // Female
                    'email_id' => 'priya.demo@gmail.com',
                    'mobile_no' => '9888877771',
                    'password' => Hash::make('password'),
                    'dob' => '1995-03-21',
                    'age' => 31,
                    'Religion' => '1',
                    'Caste' => '1',
                    'sub_caste' => '1',
                    'marital_status' => '1',
                    'Monther_tongue' => '1',
                    'height' => '1',
                    'physical_status' => '1',
                    'eating_habit' => '1',
                    'stars' => '1',
                    'rasi' => '1',
                    'country' => 'India',
                    'state' => 'Tamil Nadu',
                    'district' => 'Chennai',
                    'user_token' => 'DEMO_TOKEN_'.rand(1000, 9999),
                    'created_for' => '1',
                    'looking_for' => '1',
                    'about_myself' => 'Hi, I am looking for a suitable partner. Interested in travel and reading.',
                    'status' => 1
                ]
            );

            // 3. Create Mutual Interest (Accepted = status 1)
            InterestRequest::updateOrCreate(
                ['sender_id' => $navinUser->id, 'receiver_id' => $femaleUser->id],
                ['status' => 1] 
            );

            // 4. Create Conversation between Navin and Priya
            $conversation = Conversation::updateOrCreate(
                [
                    'user_one' => min($navinUser->id, $femaleUser->id), 
                    'user_two' => max($navinUser->id, $femaleUser->id)
                ],
                []
            );

            // 5. Add Seed Messages
            Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $femaleUser->id,
                'message' => 'Hi Navin, I really liked your profile! We have several common interests.',
                'is_read' => false
            ]);
            
            Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $navinUser->id,
                'message' => 'Hello Priya, thank you so much! I was thinking the same. Glad we connected!',
                'is_read' => true
            ]);
        });
    }
}
