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
use Illuminate\Support\Facades\DB;

class ManualUsersSeeder extends Seeder
{
    public function run(): void
    {
        $people = [
            [
                'name' => 'Arjun',
                'gender' => 'Male',
                'dob' => '1995-05-10',
                'religion' => 'Hindu',
                'caste' => 'Iyer',
                'email' => 'arjun@gmail.com',
                'mobile' => '9876543210',
                'district' => 'Chennai',
                'state' => 'Tamil Nadu',
                'education' => 'BE',
                'job' => 'Software Engineer',
                'income' => 800000,
                'interests' => 'Music, Travel',
                'star' => 'Rohini',
                'varan_id' => 'VAR001'
            ],
            [
                'name' => 'Meera',
                'gender' => 'Female',
                'dob' => '1998-03-15',
                'religion' => 'Hindu',
                'caste' => 'Iyer',
                'email' => 'meera@gmail.com',
                'mobile' => '9876543211',
                'district' => 'Chennai',
                'state' => 'Tamil Nadu',
                'education' => 'BE',
                'job' => 'Engineer',
                'income' => 600000,
                'interests' => 'Music, Travel',
                'star' => 'Rohini',
                'varan_id' => 'VAR002'
            ],
            [
                'name' => 'Kavya',
                'gender' => 'Female',
                'dob' => '2000-07-20',
                'religion' => 'Hindu',
                'caste' => 'Iyengar',
                'email' => 'kavya@gmail.com',
                'mobile' => '9876543212',
                'district' => 'Coimbatore',
                'state' => 'Tamil Nadu',
                'education' => 'MBA',
                'job' => 'Manager',
                'income' => 500000,
                'interests' => 'Music, Reading',
                'star' => 'Ashwini',
                'varan_id' => 'VAR003'
            ],
            [
                'name' => 'Divya',
                'gender' => 'Female',
                'dob' => '1997-11-05',
                'religion' => 'Hindu',
                'caste' => 'Brahmin',
                'email' => 'divya@gmail.com',
                'mobile' => '9876543213',
                'district' => 'Chennai',
                'state' => 'Tamil Nadu',
                'education' => 'BSc',
                'job' => 'Teacher',
                'income' => 400000,
                'interests' => 'Cooking, Travel',
                'star' => 'Revathi',
                'varan_id' => 'VAR004'
            ],
            [
                'name' => 'Nisha',
                'gender' => 'Female',
                'dob' => '2001-01-25',
                'religion' => 'Hindu',
                'caste' => 'Naidu',
                'email' => 'nisha@gmail.com',
                'mobile' => '9876543214',
                'district' => 'Madurai',
                'state' => 'Tamil Nadu',
                'education' => 'BCom',
                'job' => 'Accountant',
                'income' => 350000,
                'interests' => 'Travel',
                'star' => 'Swathi',
                'varan_id' => 'VAR005'
            ],
            [
                'name' => 'Priya',
                'gender' => 'Female',
                'dob' => '1999-09-18',
                'religion' => 'Hindu',
                'caste' => 'Nair',
                'email' => 'priya@gmail.com',
                'mobile' => '9876543215',
                'district' => 'Kochi',
                'state' => 'Kerala',
                'education' => 'Diploma',
                'job' => 'Designer',
                'income' => 300000,
                'interests' => 'Music',
                'star' => 'Pooram',
                'varan_id' => 'VAR006'
            ],
        ];

        foreach ($people as $p) {
            $user = User::updateOrCreate(
                ['email' => $p['email']],
                [
                    'name' => $p['name'],
                    'password' => Hash::make('password'),
                    'gender' => $p['gender'],
                    'dob' => $p['dob'],
                    'religion' => $p['religion'],
                    'caste' => $p['caste'],
                    'marital_status' => 'Never Married',
                    'mother_tongue' => 'Tamil',
                    'phone' => $p['mobile'],
                    'mblno' => $p['mobile'],
                    'user_ID' => $p['varan_id'],
                    'district' => $p['district'],
                    'status' => 1,
                    'role' => 'user'
                ]
            );

            // Legacy Table Sync
            DB::table('registers')->updateOrInsert(
                ['email_id' => $p['email']],
                [
                    'Name' => $p['name'],
                    'varan_id' => $p['varan_id'],
                    'Gender' => $p['gender'],
                    'dob' => $p['dob'],
                    'password' => $user->password,
                    'mobile_no' => $p['mobile'],
                    'status' => 1,
                    // Note: These fields might need to exist in registers table
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            UserDetail::updateOrCreate(['user_id' => $user->id], [
                'height' => '170 cm',
                'complexion' => 'Fair',
                'body_type' => 'Average',
                'eating_habit' => 'Vegetarian',
                'photo_path' => ($p['gender'] === 'Male') ? 'assets/images/matri/men.png' : 'assets/images/matri/women1.png'
            ]);

            EducationJob::updateOrCreate(['user_id' => $user->id], [
                'education' => $p['education'],
                'job_category' => 'Professional',
                'job_detail' => $p['job'],
                'annual_income' => $p['income']
            ]);

            Address::updateOrCreate(['user_id' => $user->id], [
                'country' => 'India',
                'state' => $p['state'],
                'district' => $p['district'],
                'city' => $p['district']
            ]);

            // Astrological Mappings
            $rasiMapping = [
                'Rohini' => 'Rishabam',
                'Ashwini' => 'Mesam',
                'Revathi' => 'Meenam',
                'Swathi' => 'Thulam',
                'Pooram' => 'Simmam'
            ];
            
            HoroscopeDetail::updateOrCreate(['user_id' => $user->id], [
                 'rasi' => $rasiMapping[$p['star']] ?? 'Mesam', 
                 'star' => $p['star'],
                 'dosam' => 'No'
            ]);

            PartnerPreference::updateOrCreate(['user_id' => $user->id], [
                'age_from' => 20,
                'age_to' => 40,
                'religion' => 'Hindu',
                'caste' => $p['caste'],
                'location' => 'Tamil Nadu'
            ]);
        }
    }
}
