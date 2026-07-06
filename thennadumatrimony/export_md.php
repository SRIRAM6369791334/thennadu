<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

use Illuminate\Support\Facades\DB;

$users = DB::table('registers')->orderBy('id', 'desc')->limit(50)->get();

$md = "# 50 Seeded Tamil Users Data\n\n";
$md .= "This document contains the newly seeded 50 Tamil users data from the database.\n\n";
$md .= "| Varan ID | Name | Gender | Age | Email | Mobile | District ID | Religion ID | Caste ID |\n";
$md .= "|----------|------|--------|-----|-------|--------|-------------|-------------|----------|\n";

foreach($users as $u) {
    $md .= "| {$u->varan_id} | {$u->Name} | {$u->Gender} | {$u->age} | {$u->email_id} | {$u->mobile_no} | {$u->district} | {$u->Religion} | {$u->Caste} |\n";
}

$path = 'C:/Users/srira/.gemini/antigravity/brain/e212617b-5259-4b57-898d-763e415423b5/artifacts/50_new_users_data.md';
file_put_contents($path, $md);

echo "Markdown file generated successfully at artifacts folder.\n";
