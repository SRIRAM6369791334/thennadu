<?php
require 'vendor/autoload.php';
$pusher = new \Pusher\Pusher('1','2','3',['cluster'=>'mt1']);
var_dump($pusher->authorizeChannel('private-chat.1', '1234.5678'));
