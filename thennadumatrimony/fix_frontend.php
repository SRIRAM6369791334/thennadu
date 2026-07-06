<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

// 1. Fix TamilUsersSeeder.php
$seederFile = __DIR__.'/database/seeders/TamilUsersSeeder.php';
$seederCode = file_get_contents($seederFile);

// Change religion to only 1 (Hindu)
$seederCode = str_replace('$religions    = [1, 2, 3]; // 1=Hindu, 2=Christian, 3=Muslim', '$religions    = [1]; // Force Hindu for valid castes', $seederCode);

// Fix laknam array to IDs
$seederCode = str_replace("\$laknames     = ['Mesha','Rishabha','Mithuna','Kataka','Simha','Kanni','Thula','Viruchika','Dhanusu','Makara','Kumbha','Meenam'];", '$laknames     = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];', $seederCode);

// Dynamic subcaste assignment in the loop
$findSubcasteStr = "'sub_caste'         => \$subCastes[array_rand(\$subCastes)],";
$replaceSubcasteStr = "'sub_caste'         => DB::table('subcastes')->where('Category_name', \$caste)->inRandomOrder()->value('id') ?? 1,";
$seederCode = str_replace($findSubcasteStr, $replaceSubcasteStr, $seederCode);

file_put_contents($seederFile, $seederCode);

// 2. Fix DashboardController.php to pass $cities
$controllerFile = __DIR__.'/app/Http/Controllers/DashboardController.php';
$controllerCode = file_get_contents($controllerFile);

if (strpos($controllerCode, '$cities = DB::table(\'cities\')->get();') === false) {
    $controllerCode = str_replace(
        '$complexions = DB::table(\'complexion_tb\')->get();',
        "\$complexions = DB::table('complexion_tb')->get();\n        \$cities = DB::table('cities')->get();",
        $controllerCode
    );
    $controllerCode = str_replace(
        '\'job_categories\', \'income_list\', \'body_types\', \'complexions\', \'activePackage\'',
        '\'job_categories\', \'income_list\', \'body_types\', \'complexions\', \'activePackage\', \'cities\'',
        $controllerCode
    );
    file_put_contents($controllerFile, $controllerCode);
}

// 3. Fix dashboard.blade.php
$bladeFile = __DIR__.'/resources/views/pages/dashboard.blade.php';
$bladeCode = file_get_contents($bladeFile);

// Fix District input to select
$findDistrict = '<input type="text" name="district" class="form-control rounded-pill" value="{{ $profile->district }}">';
$replaceDistrict = '<select name="district" class="form-select rounded-pill">
                                        @foreach($cities as $city)
                                            <option value="{{ $city->city_id }}" {{ $profile->district == $city->city_id ? \'selected\' : \'\' }}>{{ $city->city_name }}</option>
                                        @endforeach
                                    </select>';
$bladeCode = str_replace($findDistrict, $replaceDistrict, $bladeCode);

// Fix Job Category/Detail mismatch (dashboard uses job_detail text input instead of job_category select)
$findJob = '<input type="text" name="job_detail" class="form-control rounded-pill" value="{{ $profile->job_detail }}">';
$replaceJob = '<select name="job_category" class="form-select rounded-pill">
                                        @foreach($job_categories as $job)
                                            <option value="{{ $job->id }}" {{ $profile->job_category == $job->id ? \'selected\' : \'\' }}>{{ $job->name }}</option>
                                        @endforeach
                                    </select>';
$bladeCode = str_replace($findJob, $replaceJob, $bladeCode);

file_put_contents($bladeFile, $bladeCode);

echo "Files fixed successfully.\n";
