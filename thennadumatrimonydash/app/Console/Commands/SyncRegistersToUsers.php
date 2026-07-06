<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\register;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SyncRegistersToUsers extends Command
{
    protected $signature = 'sync:registers';
    protected $description = 'Synchronize legacy registers table to new normalized users structure';

    public function handle()
    {
        $registers = register::all();
        $this->info("Starting sync for " . $registers->count() . " records...");

        foreach ($registers as $reg) {
            // Check if user already exists based on email or varan_id
            $user = User::where('user_ID', $reg->varan_id)->orWhere('email', $reg->email_id)->first();
            
            if (!$user) {
                $user = User::create([
                    'user_ID' => $reg->varan_id,
                    'name' => $reg->Name,
                    'email' => $reg->email_id,
                    'password' => Hash::needsRehash($reg->password) ? Hash::make($reg->password) : $reg->password,
                    'mblno' => $reg->mobile_no,
                    'gender' => $reg->Gender,
                    'dob' => $reg->dob,
                    'religion' => $reg->Religion,
                    'caste' => $reg->Caste,
                    'marital_status' => $reg->marital_status,
                    'mother_tongue' => $reg->Monther_tongue,
                    'district' => $reg->district,
                    'role' => 4, // 4 for members
                ]);
            } else {
                // Update existing
                $user->update([
                    'user_ID' => $reg->varan_id,
                    'gender' => $reg->Gender,
                    'dob' => $reg->dob,
                    'religion' => $reg->Religion,
                    'caste' => $reg->Caste,
                    'marital_status' => $reg->marital_status,
                    'mother_tongue' => $reg->Monther_tongue,
                    'district' => $reg->district,
                ]);
            }

            // Sync Detail Tables
            $user->userDetail()->updateOrCreate(['user_id' => $user->id], [
                'height' => $reg->height,
                'complexion' => $reg->complexion,
                'body_type' => $reg->body_type,
                'eating_habit' => $reg->eating_habit,
            ]);

            $user->educationJob()->updateOrCreate(['user_id' => $user->id], [
                'education' => $reg->eduction,
                'job_category' => $reg->job_category,
                'job_detail' => $reg->job_detail,
                'annual_income' => $reg->annual_income,
            ]);

            $user->address()->updateOrCreate(['user_id' => $user->id], [
                'country' => $reg->country,
                'state' => $reg->state,
                'district' => $reg->district,
                'city' => $reg->municipality_panchayat,
            ]);

            $user->familyDetail()->updateOrCreate(['user_id' => $user->id], [
                'father_name' => $reg->father_name,
                'mother_name' => $reg->mother_name,
                'siblings_count' => $reg->total_sibblings,
            ]);

            $user->horoscopeDetail()->updateOrCreate(['user_id' => $user->id], [
                'rasi' => $reg->rasi,
                'star' => $reg->stars,
                'dosam' => $reg->dosam,
                'birth_time' => $reg->birth_time,
            ]);

            // Create initial partner preferences if missing
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

        $this->info("Synchronization complete.");
    }
}
