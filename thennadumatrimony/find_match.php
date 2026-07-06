<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$service = app(\App\Services\MatchmakingService::class);
// Get all active users, try to find a match >= 75%
$users = \App\Models\User::where('status', 1)->get();

$found = false;
foreach($users as $user) {
    // Attempt to find matches for this user
    $matches = $service->getPotentialMatches($user, ['show_all' => false, 'intensity' => 75, 'include_horoscope' => true]);
    foreach($matches as $match) {
        if ($match->match_score >= 75) {
            echo "====================================\n";
            echo "MATCH FOUND WITH SCORE: " . $match->match_score . "%\n";
            echo "====================================\n";
            echo "User 1: " . $user->name . " (Varan ID: " . $user->user_ID . ")\n";
            echo "User 2: " . $match->name . " (Varan ID: " . $match->user_ID . ")\n";
            echo "====================================\n";
            $found = true;
            break 2;
        }
    }
}

if (!$found) {
    echo "Could not find any two profiles with a 75%+ match based on current database records.\n";
}
