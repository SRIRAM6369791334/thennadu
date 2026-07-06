<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FetchIdsCommand extends Command
{
    protected $signature = 'fetch:ids';
    protected $description = 'Fetch all lookup IDs for seeder';

    public function handle()
    {
        $btypes = DB::table('btype_tb')->limit(5)->pluck('id')->toArray();
        $complexions = DB::table('complexion_tb')->limit(5)->pluck('id')->toArray();
        $maritals = DB::table('matrial_tb')->limit(5)->pluck('id')->toArray();
        $rasis = DB::table('rasi_tb')->limit(12)->pluck('id')->toArray();
        $stars = DB::table('star')->limit(10)->pluck('id')->toArray();
        $incomes = DB::table('income_tb')->limit(7)->pluck('id')->toArray();
        $heights = DB::table('height_tb')->limit(10)->pluck('id')->toArray();
        $jobs = DB::table('jobdescription_tb')->limit(15)->pluck('id')->toArray();

        $this->info("Body Types: " . implode(',', $btypes));
        $this->info("Complexions: " . implode(',', $complexions));
        $this->info("Marital Status: " . implode(',', $maritals));
        $this->info("Rasi: " . implode(',', $rasis));
        $this->info("Star: " . implode(',', $stars));
        $this->info("Income: " . implode(',', $incomes));
        $this->info("Height: " . implode(',', $heights));
        $this->info("Job: " . implode(',', $jobs));
    }
}
