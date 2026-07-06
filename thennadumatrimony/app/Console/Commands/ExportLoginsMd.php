<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportLoginsMd extends Command
{
    protected $signature = 'export:logins-md';
    protected $description = 'Export 50 users login credentials to markdown artifact';

    public function handle()
    {
        $users = DB::table('registers')->orderBy('id', 'desc')->limit(50)->get();

        $md = "# 50 Seeded Tamil Users - Login Credentials\n\n";
        $md .= "Use the following credentials to login and test the application.\n\n";
        $md .= "| # | Name | Email Address | Password |\n";
        $md .= "|---|---|---|---|\n";

        $i = 1;
        foreach($users as $u) {
            $md .= "| {$i} | {$u->Name} | `{$u->email_id}` | `Password@123` |\n";
            $i++;
        }

        $path = 'C:/Users/srira/.gemini/antigravity/brain/e212617b-5259-4b57-898d-763e415423b5/artifacts/login_credentials.md';
        file_put_contents($path, $md);

        $this->info("Login credentials markdown file generated successfully.");
    }
}
