<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\MatchesController;
use Illuminate\Support\Facades\DB;

class TestFilter extends Command
{
    protected $signature = 'test:filter';
    protected $description = 'Test matches filter logic';

    public function handle()
    {
        DB::enableQueryLog();

        $req = new Request();
        // Simulate empty form payload like matches.blade.php
        $req->merge([
            'partneragefrom' => null,
            'partnerageto' => null,
            'gender' => null,
            'religion' => null,
            'caste' => null
        ]);

        $controller = new MatchesController();
        $res = $controller->filterData($req);
        $data = $res->getData()['register'];

        $this->info("Matches Found with Empty Filter: " . count($data));
        
        $req->merge([
            'partneragefrom' => 18,
            'partnerageto' => 35,
            'gender' => ['Male', 'Female'],
            'religion' => [1], // Hindu
            'caste' => [5] // Gounder
        ]);
        $res2 = $controller->filterData($req);
        $data2 = $res2->getData()['register'];
        
        $this->info("Matches Found with Age & Gender Filter: " . count($data2));
        $this->info(json_encode(DB::getQueryLog(), JSON_PRETTY_PRINT));
    }
}
