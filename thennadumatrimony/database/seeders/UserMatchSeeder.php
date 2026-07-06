<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\EducationJob;
use App\Models\Address;
use App\Models\FamilyDetail;
use App\Models\HoroscopeDetail;
use App\Models\PartnerPreference;
use App\Models\MasterInterest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserMatchSeeder extends Seeder
{
    public function run(): void
    {
        // Default values for common required fields in users table
        $defaults = [
            'broker_approval_status' => 0,
            'user_payment_percentage' => 0,
            'target_value' => 0,
            'earned_amt' => '0',
            'payment_req_data' => '0',
            'earned_amt_status' => 0,
            'amt_paid_data' => '0',
            'role' => 'user'
        ];

        // 1. Create a Test User for Login (Female)
        $testUser = User::updateOrCreate(
            ['email' => 'testuser@example.com'],
            array_merge($defaults, [
                'name' => 'Meera Ravi',
                'password' => Hash::make('password'),
                'gender' => 'Female',
                'dob' => '1998-05-15',
                'religion' => 'Hindu',
                'caste' => 'Iyer',
                'marital_status' => 'Never Married',
                'mother_tongue' => 'Tamil',
                'phone' => '9876543210',
                'mblno' => '9876543210',
                'user_ID' => 'VAR100',
                'district' => 'Chennai'
            ])
        );

        // Sync test user to registers (Profile Model)
        \Illuminate\Support\Facades\DB::table('registers')->updateOrInsert(
            ['email_id' => 'testuser@example.com'],
            [
                'Name' => 'Meera Ravi',
                'varan_id' => 'VAR100',
                'Gender' => 'Female',
                'dob' => '1998-05-15',
                'password' => $testUser->password, // Map the hashed password
                'mobile_no' => '9876543210',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // Preference for Test User
        PartnerPreference::updateOrCreate(
            ['user_id' => $testUser->id],
            [
                'age_from' => 25,
                'age_to' => 35,
                'religion' => 'Hindu',
                'caste' => 'Iyer',
                'education' => 'Engineer',
                'location' => 'Chennai',
                'min_income' => 500000,
                'marital_status' => 'Never Married'
            ]
        );

        $interests = MasterInterest::limit(3)->get();
        if ($interests->isNotEmpty()) {
            $testUser->interests()->sync($interests->pluck('id'));
        }

        // 2. Create 10 Candidates (5 Male, 5 Female)
        $names = [
            'Arjun Kumar', 'Karthik Raja', 'Surya Prakash', 'Vikram Singh', 'Rahul Mani',
            'Priya Laxmi', 'Anitha Devi', 'Shruthi Iyer', 'Deepa Nair', 'Swetha S.'
        ];

        $genders = ['Male', 'Male', 'Male', 'Male', 'Male', 'Female', 'Female', 'Female', 'Female', 'Female'];
        $images = [
            'assets/images/matri/men.png', 
            'assets/images/matri/men2.png',
            'assets/images/matri/men.png', 
            'assets/images/matri/men2.png',
            'assets/images/matri/men.png',
            'assets/images/matri/women1.png', 
            'assets/images/matri/women 2.png', 
            'assets/images/matri/portrait-beautiful-woman-wearing-traditional-sari-garment.jpg',
            'assets/images/matri/women1.png',
            'assets/images/matri/women 2.png'
        ];

        foreach ($names as $index => $name) {
            $gender = $genders[$index];
            $email = strtolower(str_replace(' ', '.', $name)) . rand(1,999) . '@example.com';
            $varanId = 'VAR' . (101 + $index);
            
            $candidate = User::create(array_merge($defaults, [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'gender' => $gender,
                'dob' => Carbon::now()->subYears(rand(24, 32))->toDateString(),
                'religion' => 'Hindu',
                'caste' => 'Iyer',
                'marital_status' => 'Never Married',
                'mother_tongue' => 'Tamil',
                'phone' => '9000000' . rand(100, 999) . $index,
                'mblno' => '9000000' . rand(100, 999) . $index,
                'user_ID' => $varanId,
                'district' => 'Chennai'
            ]));

            // CRITICAL: Synchronize with registers table (Profile Model)
            \Illuminate\Support\Facades\DB::table('registers')->updateOrInsert(
                ['email_id' => $email],
                [
                    'Name' => $name,
                    'varan_id' => $varanId,
                    'Gender' => $gender,
                    'dob' => $candidate->dob,
                    'password' => $candidate->password,
                    'mobile_no' => $candidate->phone,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            UserDetail::create([
                'user_id' => $candidate->id,
                'height' => rand(150, 180) . ' cm',
                'complexion' => 'Fair',
                'body_type' => 'Average',
                'eating_habit' => 'Vegetarian',
                'photo_path' => $images[$index]
            ]);

            EducationJob::create([
                'user_id' => $candidate->id,
                'education' => ($index < 5) ? 'Engineer' : 'Doctor',
                'job_category' => 'Software Profession',
                'job_detail' => 'Senior Developer',
                'annual_income' => rand(600000, 1200000)
            ]);

            Address::create([
                'user_id' => $candidate->id,
                'country' => 'India',
                'state' => 'Tamil Nadu',
                'district' => 'Chennai',
                'city' => 'Chennai'
            ]);

            FamilyDetail::create([
                'user_id' => $candidate->id,
                'father_name' => 'Father ' . $index,
                'mother_name' => 'Mother ' . $index,
                'siblings_count' => rand(0, 2)
            ]);

            HoroscopeDetail::create([
                'user_id' => $candidate->id,
                'rasi' => 'Mesham',
                'star' => 'Ashwini',
                'dosam' => 'No',
                'birth_time' => '10:00:00'
            ]);

            PartnerPreference::create([
                'user_id' => $candidate->id,
                'age_from' => 21,
                'age_to' => 35,
                'religion' => 'Hindu',
                'caste' => 'Iyer',
                'education' => ($gender === 'Male') ? 'Professional' : 'Engineer',
                'location' => 'Chennai',
                'min_income' => 300000,
                'marital_status' => 'Never Married'
            ]);

            if ($interests->isNotEmpty()) {
                $candidate->interests()->sync($interests->pluck('id'));
            }
        }
    }
}
