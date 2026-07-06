<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

use Illuminate\Http\Request;
use App\Http\Controllers\MatchesController;
use Illuminate\Support\Facades\DB;

DB::enableQueryLog();

$req = new Request();
$req->merge([
    'partneragefrom' => 18,
    'partnerageto' => 35,
    'gender' => ['Female'],
    'religion' => [2],
    'caste' => [4]
]);

$controller = new MatchesController();
$res = $controller->filterData($req);
$data = $res->getData()['register'];

echo "Matches Found: " . count($data) . "\n";
print_r(DB::getQueryLog());
