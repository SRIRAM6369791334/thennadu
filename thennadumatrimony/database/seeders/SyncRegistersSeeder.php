<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SyncRegistersSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            $exists = DB::table('registers')->where('varan_id', $user->user_ID)->exists();
            if (!$exists) {
                echo "Syncing {$user->user_ID} ({$user->name})...\n";
                DB::table('registers')->insert([
                    'created_for' => 'self',
                    'looking_for' => ($user->gender === 'Female') ? 'M' : 'F',
                    'Name' => $user->name,
                    'varan_id' => $user->user_ID,
                    'Gender' => $user->gender ?? 'Male',
                    'dob' => $user->dob ?? '1990-01-01',
                    'age' => $user->dob ? \Carbon\Carbon::parse($user->dob)->age : 34,
                    'Monther_tongue' => $user->mother_tongue ?? 'Tamil',
                    'Religion' => $user->religion ?? 'Hindu',
                    'Caste' => $user->caste ?? 'Iyer',
                    'sub_caste' => '',
                    'mobileno_code' => '',
                    'mobile_no' => $user->phone ?? ($user->mblno ?? '0000000000'),
                    'aadhaar_no' => '',
                    'email_id' => $user->email,
                    'password' => $user->password,
                    'physical_status' => 1,
                    'body_type' => 1,
                    'complexion' => 1,
                    'height' => ($user->userDetail->height ?? '160 cm'),
                    'marital_status' => $user->marital_status ?? 'Never Married',
                    'eating_habit' => ($user->userDetail->eating_habit ?? 'Vegetarian'),
                    'no_of_children' => 0,
                    'whatsapp_no' => '',
                    'com_address' => '',
                    'country' => 'India',
                    'state' => ($user->address->state ?? 'Tamil Nadu'),
                    'district' => $user->district ?? 'Chennai',
                    'municipality_panchayat' => '',
                    'other_countryaddress' => 0,
                    'residential_address' => 0,
                    'eduction' => ($user->educationJob->education ?? 'Degree'),
                    'eduction_detail' => '',
                    'job_category' => '',
                    'job_detail' => ($user->educationJob->job_detail ?? 'Employee'),
                    'job_country' => '',
                    'job_state' => '',
                    'job_city' => '',
                    'job_location' => '',
                    'annual_income' => ($user->educationJob->annual_income ?? 0),
                    'father_name' => '',
                    'father_occuption' => '',
                    'mother_name' => '',
                    'mother_occuption' => '',
                    'total_sibblings' => 0,
                    'elder_sister' => 0,
                    'younger_sister' => 0,
                    'elder_brother' => 0,
                    'younger_brother' => 0,
                    'about_myself' => '',
                    'interests' => '',
                    'rasi' => ($user->horoscopeDetail->rasi ?? ''),
                    'laknam' => '',
                    'stars' => ($user->horoscopeDetail->star ?? ''),
                    'dosam' => ($user->horoscopeDetail->dosam ?? 'No'),
                    'birth_time' => null,
                    'status' => $user->status ?? 1,
                    'member_shiptype' => 0,
                    'cprivacy_setting' => 'None',
                    'bprivacy_setting' => 'None',
                    'created_at' => $user->created_at ?? now(),
                    'updated_at' => $user->updated_at ?? now(),
                    'deleted_id' => null,
                    'blood_group' => '',
                    'account_setting' => 'view',
                    'delete_setting' => '',
                    'delete_reason' => '',
                    'brokerid' => 0,
                    'user_token' => ($user->user_token ?? \Illuminate\Support\Str::random(60)),
                    'blockstatus' => 0
                ]);
            }
        }
    }
}
