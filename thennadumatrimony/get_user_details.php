<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$candidate = \App\Models\User::with(['userDetail', 'educationJob', 'address'])->where('user_ID', 'V260511115')->first();

if($candidate) {
    echo "Name: " . $candidate->name . "\n";
    echo "ID: " . $candidate->user_ID . "\n";
    echo "Gender: " . $candidate->gender . "\n";
    echo "Age: " . \Carbon\Carbon::parse($candidate->dob)->age . "\n";
    echo "Religion: " . $candidate->religion . "\n";
    echo "Caste: " . $candidate->caste . "\n";
    echo "Marital Status: " . $candidate->marital_status . "\n";
    echo "Education: " . ($candidate->educationJob->education ?? 'N/A') . "\n";
    echo "State: " . ($candidate->address->state ?? 'N/A') . "\n";
    echo "District: " . ($candidate->address->district ?? 'N/A') . "\n";
} else {
    echo "User not found";
}
