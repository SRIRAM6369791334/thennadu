<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

$users = DB::table('registers')->orderBy('id','desc')->limit(50)->get();

echo str_pad("ID", 5) . str_pad("VaranID", 15) . str_pad("Name", 30) . str_pad("Gender", 8) . str_pad("Age", 5) . str_pad("District", 20) . str_pad("Education", 12) . str_pad("Job", 28) . str_pad("Religion-Caste", 30) . "\n";
echo str_repeat("-", 160) . "\n";

foreach ($users as $u) {
    echo str_pad($u->id, 5)
       . str_pad($u->varan_id, 15)
       . str_pad($u->Name, 30)
       . str_pad($u->Gender, 8)
       . str_pad($u->age, 5)
       . str_pad($u->district, 20)
       . str_pad($u->eduction, 12)
       . str_pad($u->job_detail, 28)
       . str_pad($u->Religion . ' - ' . $u->Caste, 30)
       . "\n";
}

echo "\nTotal users in DB: " . DB::table('registers')->count() . "\n";
echo "Total partner prefs: " . DB::table('partners')->count() . "\n";
