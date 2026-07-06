<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$candidate = \App\Models\User::with(['userDetail', 'educationJob', 'address'])->where('gender', 'Female')->where('status', 1)->first();

if($candidate) {
    echo "Name: " . $candidate->name . "\n";
    echo "ID: " . $candidate->user_ID . "\n";
    echo "Gender: " . $candidate->gender . "\n";
    echo "Age: " . \Carbon\Carbon::parse($candidate->dob)->age . "\n";
    echo "Religion: " . \Illuminate\Support\Facades\DB::table('regli_tb')->where('id', $candidate->religion)->value('religion_name') . "\n";
    echo "Caste: " . \Illuminate\Support\Facades\DB::table('castes')->where('id', $candidate->caste)->value('Caste_name') . "\n";
    echo "Marital Status: " . \Illuminate\Support\Facades\DB::table('matrial_tb')->where('id', $candidate->marital_status)->value('matrial_name') . "\n";
} else {
    echo "User not found";
}
