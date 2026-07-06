<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

Schema::table('users', function(Blueprint $table) {
    // Drop unique index on name if it exists
    $sm = Schema::getConnection()->getDoctrineSchemaManager();
    $indexesFound = $sm->listTableIndexes('users');

    if (array_key_exists('users_name_unique', $indexesFound)) {
        $table->dropUnique('users_name_unique');
        echo "Dropped users_name_unique\n";
    }
    
    // Also drop phone unique if it exists to be safe
    if (array_key_exists('users_phone_unique', $indexesFound)) {
        $table->dropUnique('users_phone_unique');
        echo "Dropped users_phone_unique\n";
    }
});
