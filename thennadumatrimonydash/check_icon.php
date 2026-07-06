<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$menu = DB::table('menupermissions')->where('mainmenu', 'Dynamic Banners')->first();
if ($menu) {
    echo "Icon: " . $menu->menuicon . "\n";
} else {
    echo "NotFound\n";
}
