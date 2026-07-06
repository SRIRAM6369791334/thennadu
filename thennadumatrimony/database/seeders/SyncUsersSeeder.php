<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SyncUsersSeeder extends Seeder
{
    public function run(): void
    {
        $seeded = DB::table('registers')->orderBy('id', 'desc')->limit(50)->get();

        foreach($seeded as $u) {
            $exists = DB::table('users')->where('user_ID', $u->varan_id)->exists();
            if (!$exists) {
                DB::table('users')->insert([
                    'user_ID' => $u->varan_id,
                    'name' => $u->Name,
                    'email' => $u->email_id,
                    'mblno' => $u->mobile_no,
                    'password' => $u->password,
                    'role' => 4,
                    'gender' => $u->Gender,
                    'dob' => $u->dob,
                    'religion' => $u->Religion,
                    'caste' => $u->Caste,
                    'marital_status' => $u->marital_status,
                    'mother_tongue' => $u->Monther_tongue,
                    'district' => $u->district,
                    'status' => $u->status,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        $this->command->info('Users table successfully synced from registers table.');
    }
}
