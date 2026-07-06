<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

use Illuminate\Support\Facades\DB;

$seeded = DB::table('registers')->orderBy('id', 'desc')->limit(50)->get();

foreach($seeded as $u) {
    DB::table('users')->updateOrInsert(
        ['user_ID' => $u->varan_id],
        [
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
            'created_at' => $u->created_at,
            'updated_at' => $u->updated_at
        ]
    );
}

echo "Successfully copied 50 seeded users into the 'users' table!\n";
