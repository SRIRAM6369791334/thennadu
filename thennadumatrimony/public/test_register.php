<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// Simulate OTP verification in session
Session::put('otp_verified', true);
Session::put('otp_email', 'tester@gmail.com');
Session::put('otp_mobile', '9876543210');

// Create request with all form inputs from the 7 steps
$requestData = [
    'profile_for' => 'self',
    'full_name' => 'Test User',
    'mobile' => '9876543210',
    'email' => 'tester@gmail.com',
    'dob' => '1995-05-15',
    'gender' => 'male',
    'height' => '172',
    'physical_status' => '1',
    'marital_status' => '1',
    'body_type' => '2',
    'complexion' => '2',
    'blood_group' => 'B+',
    'eating_habit' => 'Vegetarian',
    'religion' => '1',
    'caste' => '3',
    'sub_caste' => '10',
    'mother_tongue' => 'Tamil',
    'birth_time' => '10:30',
    'rasi' => '2',
    'laknam' => '3',
    'star' => '4',
    'dosam' => 'No',
    'country' => '101',
    'state' => 'Tamil Nadu',
    'city' => 'Chennai',
    'education' => '3',
    'college' => 'Tester College',
    'employment_type' => '1',
    'job_category' => '4',
    'occupation' => 'Tester Job',
    'annual_income' => '5',
    'work_location' => 'Chennai Office',
    'father_name' => 'Father Test',
    'father_occuption' => 'Farmer',
    'mother_name' => 'Mother Test',
    'mother_occuption' => 'Housewife',
    'total_sibblings' => '2',
    'elder_sister' => '1',
    'younger_sister' => '0',
    'elder_brother' => '1',
    'younger_brother' => '0',
    'interests' => 'reading,music',
    'password' => 'Tester@123',
];

$request = Request::create('/register', 'POST', $requestData);

// Disable redirect and exception handling to see raw errors if any
$controller = new ProfileController();
try {
    echo "Running controller store method...\n";
    $response = $controller->store($request);
    echo "Controller store finished successfully.\n";
} catch (\Exception $e) {
    echo "Controller store threw an Exception: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
    exit;
}

// Check what is in DB
$reg = DB::table('registers')->where('email_id', 'tester@gmail.com')->first();
if (!$reg) {
    echo "Error: Record was not saved in registers table!\n";
    exit;
}

echo "\nCOMPARING REQUEST DATA VS STORED DATA IN 'registers':\n";

$mapping = [
    'profile_for' => 'created_for',
    'full_name' => 'Name',
    'mobile' => 'mobile_no',
    'email' => 'email_id',
    'dob' => 'dob',
    'gender' => 'Gender',
    'height' => 'height',
    'physical_status' => 'physical_status',
    'marital_status' => 'marital_status',
    'body_type' => 'body_type',
    'complexion' => 'complexion',
    'blood_group' => 'blood_group',
    'eating_habit' => 'eating_habit',
    'religion' => 'Religion',
    'caste' => 'Caste',
    'sub_caste' => 'sub_caste',
    'mother_tongue' => 'Monther_tongue',
    'birth_time' => 'birth_time',
    'rasi' => 'rasi',
    'laknam' => 'laknam',
    'star' => 'stars',
    'dosam' => 'dosam',
    'country' => 'country',
    'state' => 'state',
    'city' => 'district',
    'education' => 'eduction',
    'college' => 'eduction_detail',
    'job_category' => 'job_category',
    'occupation' => 'job_detail',
    'annual_income' => 'annual_income',
    'work_location' => 'job_location',
    'father_name' => 'father_name',
    'father_occuption' => 'father_occuption',
    'mother_name' => 'mother_name',
    'mother_occuption' => 'mother_occuption',
    'total_sibblings' => 'total_sibblings',
    'elder_sister' => 'elder_sister',
    'younger_sister' => 'younger_sister',
    'elder_brother' => 'elder_brother',
    'younger_brother' => 'younger_brother',
    'interests' => 'interests',
];

$missingCount = 0;
foreach ($mapping as $reqField => $dbCol) {
    $expected = $requestData[$reqField];
    $actual = $reg->$dbCol;
    
    // Normalize gender case comparison
    if ($reqField === 'gender') {
        $expected = ucfirst($expected);
    }
    
    if (is_null($actual) || $actual === '') {
        echo "❌ FIELD NOT STORED: Request key '$reqField' maps to DB column '$dbCol', but DB value is EMPTY!\n";
        $missingCount++;
    } else if (trim($expected) != trim($actual)) {
        echo "⚠️ FIELD MISMATCH: Request key '$reqField' expected '$expected', but DB column '$dbCol' has '$actual'!\n";
    } else {
        echo "✅ Mapped: '$reqField' -> '$dbCol' (Value: '$actual')\n";
    }
}

// Also check fields present in request but not in mapping
echo "\nCHECKING FIELDS IN REQUEST THAT HAVE NO MAPPED COLUMN IN DB:\n";
foreach ($requestData as $key => $val) {
    if ($key !== 'password' && !isset($mapping[$key])) {
        echo "❓ Unmapped field in request: '$key' => '$val'\n";
    }
}

// Delete test record to keep database clean
DB::table('registers')->where('email_id', 'tester@gmail.com')->delete();
DB::table('users')->where('email', 'tester@gmail.com')->delete();
echo "\nTest cleanup complete.\n";
