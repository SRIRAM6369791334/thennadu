<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    DB::statement('ALTER TABLE users DROP INDEX users_name_unique');
    echo "Dropped users_name_unique\n";
} catch (\Exception $e) {}

try {
    DB::statement('ALTER TABLE users DROP INDEX users_phone_unique');
    echo "Dropped users_phone_unique\n";
} catch (\Exception $e) {}
