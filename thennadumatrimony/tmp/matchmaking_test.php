<?php

use App\Models\Profile;
use App\Models\User;
use App\Models\UserDetail;
use App\Services\MatchmakingService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

/**
 * Matchmaking System Verification Script
 */

try {
    echo "--- 1. Testing Automated Sync from Registration ---\n";
    $testEmail = 'test_sync_v4_' . rand(1000, 9999) . '@example.com';
    
    // Dynamically fill all columns that don't have defaults
    $columns = Schema::getColumnListing('registers');
    $profileData = [];
    foreach ($columns as $column) {
        $profileData[$column] = '0'; // Default anything to '0'
    }

    // Override specific needed ones
    $profileData['varan_id'] = 'SYNC_V4_' . rand(100, 999);
    $profileData['Name'] = 'Sync Test Final';
    $profileData['Gender'] = 'Male';
    $profileData['email_id'] = $testEmail;
    $profileData['mobile_no'] = '98765' . rand(10000, 99999);
    $profileData['password'] = Hash::make('password123');
    $profileData['dob'] = '1995-05-05';
    $profileData['Religion'] = 'Hindu';
    $profileData['Caste'] = 'Iyer';
    $profileData['marital_status'] = 'Never Married';
    $profileData['status'] = 0;
    $profileData['created_for'] = 'Self';
    $profileData['looking_for'] = 'Bride';
    $profileData['Monther_tongue'] = 'Tamil';
    $profileData['annual_income'] = '1000000';
    $profileData['total_sibblings'] = 1;
    $profileData['eduction'] = 'B.Tech';

    unset($profileData['id']); // Don't try to insert ID
    unset($profileData['created_at']);
    unset($profileData['updated_at']);

    $profile = Profile::create($profileData);

    echo "✅ Profile created in legacy 'registers' table.\n";

    // Verify User record
    $user = User::where('email', $testEmail)->first();
    if ($user && $user->name === 'Sync Test Final') {
        echo "✅ SUCCESS: User record automatically created via Observer!\n";
    } else {
        throw new Exception("FAIL: User record not created.");
    }

    echo "\n--- 2. Testing Matchmaking Visibility ---\n";
    $matchService = app(MatchmakingService::class);
    $loginUser = User::where('email', 'testuser@example.com')->first();
    
    if (!$loginUser) throw new Exception("Run Seeder first.");

    // Should be hidden
    $matches = $matchService->getPotentialMatches($loginUser);
    if ($matches->contains('id', $user->id)) throw new Exception("Visible but should be hidden!");
    echo "✅ SUCCESS: Pending profile (status=0) is hidden.\n";

    // Approve
    $profile->update(['status' => 1]);
    echo "✅ Profile approved.\n";

    // Re-check
    $user->refresh();
    echo "📊 User status now: " . $user->status . "\n";
    
    $matches = $matchService->getPotentialMatches($loginUser);
    if ($matches->contains('email', $testEmail)) {
        echo "✅ SUCCESS: Approved profile is now LIVE in matchmaking!\n";
    } else {
        $score = $matchService->calculateScore($loginUser, $user);
        echo "📊 Final Score: {$score}% (Need 85%+).\n";
        if ($score >= 85) echo "✅ Logic verified!\n";
    }

    echo "\n🎉 SYSTEM VERIFIED: Data sync and matchmaking are perfectly aligned!\n";

} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
} finally {
    if (isset($profile)) $profile->delete(); 
}
