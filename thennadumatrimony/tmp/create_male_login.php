<?php
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

$male = Profile::updateOrCreate(
    ['email_id' => 'rahul.test@example.com'],
    [
        'varan_id' => 'M101',
        'Name' => 'Rahul Mani',
        'Gender' => 'Male',
        'mobile_no' => '9990001112',
        'user_token' => 'TEST_TOKEN',
        'password' => Hash::make('password'),
        'dob' => '1995-05-05',
        'age' => 29,
        'Religion' => 'Hindu',
        'Caste' => 'Iyer',
        'marital_status' => 'Never Married',
        'status' => 1,
        'created_for' => 'Self',
        'looking_for' => '1',
        'Monther_tongue' => 'Tamil',
        'physical_status' => 'Normal',
        'eduction' => 'B.E',
        'job_category' => 'IT',
        'annual_income' => '800000',
        'father_name' => 'F',
        'mother_name' => 'M',
        'total_sibblings' => 1,
        'sub_caste' => 'None',
        'country' => 'India',
        'state' => 'Tamil Nadu',
        'district' => 'Chennai',
        'municipality_panchayat' => 'Chennai'
    ]
);

echo "Created Male Login: " . $male->email_id . "\n";
