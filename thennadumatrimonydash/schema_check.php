<?php
use Illuminate\Support\Facades\Schema;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = ['registers', 'users', 'user_details', 'education_jobs', 'addresses', 'family_details', 'horoscope_details', 'master_interests', 'user_interests', 'partner_preferences'];
foreach ($tables as $table) {
    if (Schema::hasTable($table)) {
        echo "Table: $table\n";
        print_r(Schema::getColumnListing($table));
    } else {
        echo "Table: $table (NO FOUND)\n";
    }
}
