<?php

namespace App\Observers;

use App\Models\Profile;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\EducationJob;
use App\Models\Address;
use App\Models\FamilyDetail;
use App\Models\HoroscopeDetail;
use App\Models\PartnerPreference;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileObserver
{
    public function saved(Profile $profile)
    {
        $this->syncToUser($profile);
    }

    protected function syncToUser(Profile $reg)
    {
        // 1. Core User Record
        $user = User::where('user_ID', $reg->varan_id)->orWhere('email', $reg->email_id)->first();
        
        $userData = [
            'user_ID' => $reg->varan_id,
            'name' => $reg->Name,
            'email' => $reg->email_id,
            'mblno' => $reg->mobile_no,
            'phone' => $reg->mobile_no,
            'gender' => ($reg->Gender == 1 || $reg->Gender == 'Male') ? 'Male' : (($reg->Gender == 2 || $reg->Gender == 'Female') ? 'Female' : $reg->Gender),
            'dob' => $reg->dob,
            'religion' => $reg->Religion,
            'caste' => $reg->Caste,
            'marital_status' => $reg->marital_status,
            'mother_tongue' => $reg->Monther_tongue,
            'district' => $reg->district,
            'status' => $reg->status,
            'role' => 4, // Member
        ];

        // Passwords in "registers" can be pre-hashed or not.
        if ($reg->isDirty('password')) {
            $userData['password'] = Hash::needsRehash($reg->password) ? Hash::make($reg->password) : $reg->password;
        }

        if (!$user) {
            $user = User::create($userData);
        } else {
            $user->update($userData);
        }

        // 2. User Details
        $user->userDetail()->updateOrCreate(['user_id' => $user->id], [
            'height' => $reg->height,
            'complexion' => $reg->complexion,
            'body_type' => $reg->body_type,
            'blood_group' => $reg->blood_group,
            'eating_habit' => $reg->eating_habit,
        ]);

        // 3. Education & Jobs
        $user->educationJob()->updateOrCreate(['user_id' => $user->id], [
            'education' => $reg->eduction,
            'job_category' => $reg->job_category,
            'job_detail' => $reg->job_detail,
            'annual_income' => $reg->annual_income,
        ]);

        // 4. Address
        $user->address()->updateOrCreate(['user_id' => $user->id], [
            'country' => $reg->country,
            'state' => $reg->state,
            'district' => $reg->district,
            'city' => $reg->municipality_panchayat,
        ]);

        // 5. Family Details
        $user->familyDetail()->updateOrCreate(['user_id' => $user->id], [
            'father_name' => $reg->father_name,
            'mother_name' => $reg->mother_name,
            'siblings_count' => $reg->total_sibblings,
        ]);

        // 6. Horoscope
        $user->horoscopeDetail()->updateOrCreate(['user_id' => $user->id], [
            'rasi' => $reg->rasi,
            'star' => $reg->stars,
            'dosam' => $reg->dosam,
            'birth_time' => $reg->birth_time,
        ]);

        // 7. Initial Partner Preference
        if (!$user->partnerPreference) {
            $user->partnerPreference()->create([
                'age_from' => 18,
                'age_to' => 60,
                'religion' => $reg->Religion,
                'caste' => $reg->Caste,
                'marital_status' => $reg->marital_status,
            ]);
        }
    }

    public function deleted(Profile $reg)
    {
        $user = User::where('user_ID', $reg->varan_id)->first();
        if ($user) {
            $user->delete();
        }
    }
}
