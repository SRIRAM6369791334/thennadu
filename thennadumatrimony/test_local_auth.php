<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = \Illuminate\Http\Request::create('/broadcasting/auth', 'POST', [
    'channel_name' => 'private-chat.1', 
    'socket_id' => '1234.5678'
]);
// $request->headers->set('X-CSRF-TOKEN', '...'); // Bypass CSRF by logging in directly?
$user = \App\Models\Profile::first();
if($user) {
    auth()->login($user);
}

$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\nContent: " . $response->getContent();
