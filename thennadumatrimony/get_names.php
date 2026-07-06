<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Religion 1: " . \Illuminate\Support\Facades\DB::table('regli_tb')->where('id', 1)->value('religion_name') . "\n";
echo "Caste 1: " . \Illuminate\Support\Facades\DB::table('castes')->where('id', 1)->value('Caste_name') . "\n";
echo "Marital Status 4: " . \Illuminate\Support\Facades\DB::table('matrial_tb')->where('id', 4)->value('matrial_name') . "\n";
