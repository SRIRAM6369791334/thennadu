<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

use Illuminate\Support\Facades\DB;

$tnCities = DB::table('cities')->where('state_id', 514)->limit(10)->pluck('city_id')->toArray();
$castes = DB::table('castes')->limit(10)->pluck('id')->toArray();
$educations = DB::table('eductiondetails_tb')->limit(10)->pluck('id')->toArray();
$religions = DB::table('regli_tb')->limit(3)->pluck('id')->toArray();

echo "TN Cities: " . implode(',', $tnCities) . "\n";
echo "Castes: " . implode(',', $castes) . "\n";
echo "Education: " . implode(',', $educations) . "\n";
echo "Religions: " . implode(',', $religions) . "\n";
