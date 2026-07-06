<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

use Illuminate\Support\Facades\DB;

$btypes = DB::table('btype_tb')->limit(5)->pluck('id')->toArray();
$complexions = DB::table('complexion_tb')->limit(5)->pluck('id')->toArray();
$maritals = DB::table('matrial_tb')->limit(5)->pluck('id')->toArray();
$rasis = DB::table('rasi_tb')->limit(12)->pluck('id')->toArray();
$stars = DB::table('star')->limit(10)->pluck('id')->toArray();
$incomes = DB::table('income_tb')->limit(7)->pluck('id')->toArray();
$heights = DB::table('height_tb')->limit(10)->pluck('id')->toArray();
$jobs = DB::table('jobdescription_tb')->limit(15)->pluck('id')->toArray();

echo "Body Types: " . implode(',', $btypes) . "\n";
echo "Complexions: " . implode(',', $complexions) . "\n";
echo "Marital Status: " . implode(',', $maritals) . "\n";
echo "Rasi: " . implode(',', $rasis) . "\n";
echo "Star: " . implode(',', $stars) . "\n";
echo "Income: " . implode(',', $incomes) . "\n";
echo "Height: " . implode(',', $heights) . "\n";
echo "Job: " . implode(',', $jobs) . "\n";
