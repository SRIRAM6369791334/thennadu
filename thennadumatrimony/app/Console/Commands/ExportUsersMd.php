<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportUsersMd extends Command
{
    protected $signature = 'export:users-md';
    protected $description = 'Export 50 users to markdown artifact';

    public function handle()
    {
        $users = DB::table('registers')->orderBy('id', 'desc')->limit(50)->get();

        $md = "# 50 Seeded Tamil Users Data (Complete Details)\n\n";
        $md .= "This document contains the newly seeded 50 Tamil users data from the database, including all their fields.\n\n";
        $md .= "| Varan ID | Name | Gender | Password (Login) | Age | DOB | Email | Mobile | District ID | Religion ID | Caste ID | Sub Caste | Height | Body Type | Complexion | Blood Group | Marital Status | Eating Habit | Education ID | Job | Income | Rasi | Star | Laknam | Dosam | Father | Mother | Siblings |\n";
        $md .= "|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|\n";

        foreach($users as $u) {
            $md .= "| {$u->varan_id} | {$u->Name} | {$u->Gender} | **Password@123** | {$u->age} | {$u->dob} | {$u->email_id} | {$u->mobile_no} | {$u->district} | {$u->Religion} | {$u->Caste} | {$u->sub_caste} | {$u->height} | {$u->body_type} | {$u->complexion} | {$u->blood_group} | {$u->marital_status} | {$u->eating_habit} | {$u->eduction} | {$u->job_detail} | {$u->annual_income} | {$u->rasi} | {$u->stars} | {$u->laknam} | {$u->dosam} | {$u->father_name} | {$u->mother_name} | {$u->total_sibblings} |\n";
        }

        $path = 'C:/Users/srira/.gemini/antigravity/brain/e212617b-5259-4b57-898d-763e415423b5/artifacts/50_new_users_data.md';
        file_put_contents($path, $md);

        $this->info("Markdown file generated successfully at artifacts folder.");
    }
}
