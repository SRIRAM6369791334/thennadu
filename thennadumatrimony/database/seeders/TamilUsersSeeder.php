<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TamilUsersSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Data Pools ──────────────────────────────────────────────
        $maleNames = [
            'Arjun Krishnamurthy','Karthik Subramanian','Murugan Selvam','Vijay Rajan',
            'Senthil Kumar','Dinesh Balaji','Praveen Natarajan','Arun Pandian',
            'Suresh Thiagarajan','Ganesh Moorthy','Ramesh Velayutham','Sathish Periyasamy',
            'Anand Raghavan','Balamurugan Pillai','Deepak Sundarajan','Harish Chandran',
            'Inbaraj Muthusamy','Jeeva Sundaram','Kamal Venkatesh','Logesh Arumugam',
            'Manikandan Ramasamy','Naveen Palanisamy','Pradeep Gopalakrishnan','Rajesh Annamalai',
            'Shankar Duraisamy',
        ];

        $femaleNames = [
            'Priya Sundaram','Kavitha Ramasamy','Meena Krishnamurthy','Divya Subramanian',
            'Suganya Murugesan','Lakshmi Natarajan','Anitha Balaji','Revathi Selvam',
            'Deepa Venkataraman','Saranya Pillai','Nithya Chandran','Radha Moorthy',
            'Geetha Thiagarajan','Kalpana Periyasamy','Bhavani Rajan','Mythili Arumugam',
            'Padma Sundararajan','Rohini Gopalakrishnan','Sangeetha Muthusamy','Tamilselvi Palanisamy',
            'Usha Ramachandran','Vasantha Annamalai','Yamuna Duraisamy','Malathi Raghavan',
            'Indumathi Velayutham',
        ];

        $fatherNames = [
            'Krishnamurthy Pillai','Subramanian Iyengar','Selvam Murugan','Rajan Alagarsamy',
            'Kumar Perumal','Balaji Natarajan','Natarajan Velu','Pandian Arumugam',
            'Thiagarajan Chettiar','Moorthy Gounder','Velayutham Pillai','Periyasamy Gopalakrishnan',
            'Raghavan Iyer','Pillai Chandrasekaran','Sundarajan Venkataraman','Chandran Muthusamy',
            'Muthusamy Karuppasamy','Sundaram Ramasamy','Venkatesh Narayanan','Arumugam Durai',
            'Ramasamy Nadar','Palanisamy Gopalakrishnan','Gopalakrishnan Ponnusamy',
            'Annamalai Duraisamy','Duraisamy Murugesan',
        ];

        $motherNames = [
            'Meenakshi Pillai','Saraswathi Subramanian','Parvathi Selvam','Kamala Rajan',
            'Umayal Kumar','Gomathi Balaji','Vimala Natarajan','Malathi Pandian',
            'Thayammal Thiagarajan','Lakshmi Moorthy','Chellammal Velayutham','Ponnammal Periyasamy',
            'Savithri Raghavan','Saroja Pillai','Padmavathi Sundarajan','Radha Chandran',
            'Amudha Muthusamy','Vasantha Sundaram','Kavitha Venkatesh','Jayanthi Arumugam',
            'Selvi Ramasamy','Chitra Palanisamy','Devaki Gopalakrishnan','Mangalam Annamalai',
            'Santhi Duraisamy',
        ];

        $districts = [4551, 4552, 4553, 4554, 4555, 4556, 4557, 4558, 4559, 4560]; // Valid TN City IDs
        $educations = [1, 2, 3, 4]; // Valid Education IDs
        $colleges   = [
            'Anna University Chennai','PSG College of Technology Coimbatore','Thiagarajar College of Engineering Madurai',
            'Government College of Technology Salem','NIT Trichy','Madurai Kamaraj University',
            'Bharathiar University Coimbatore','Annamalai University','VIT University Vellore',
            'Kongu Engineering College Erode','Karpagam Academy Coimbatore','SSN College Chennai',
        ];
        $jobDetails = [
            'Software Engineer','Mechanical Engineer','Civil Engineer','Teacher','Nurse','Doctor',
            'Accountant','Bank Employee','Government Officer','Private Company Employee',
            'Business Owner','IT Analyst','System Administrator','Data Analyst','HR Executive',
        ];
        $jobLocations = ['Chennai','Coimbatore','Bengaluru','Hyderabad','Pune','Mumbai','Delhi','Erode','Madurai','Salem'];
        $incomes      = [1, 2, 3, 4, 5, 6, 7]; // Valid Income IDs
        $religions    = [1, 2, 3]; // 1=Hindu, 2=Christian, 3=Muslim
        $castes       = [1, 2, 3, 4, 5]; // Valid Caste IDs
        $subCastes    = ['Kongu Vellala Gounder','Karkatta Vellalar','Sri Vaishnava','Saiva Vellalar','Mudaliar'];
        $heights      = [147, 149, 152, 154, 157, 160, 162, 165, 167, 170, 172, 175, 177, 180, 182]; // Valid Height IDs (4ft 10in to 6ft 0in)
        $bodyTypes    = [1, 2, 3, 4]; // Valid Body Type IDs
        $complexions  = [1, 2, 3]; // Valid Complexion IDs
        $bloodGroups  = ['O+','A+','B+','AB+','O-','A-','B-','AB-'];
        $maritalStats = [1, 2, 3, 4, 5]; // Valid Marital Status IDs
        $eatingHabits = ['Vegetarian','Non-Vegetarian','Eggetarian'];
        $motherTongues= ['Tamil'];
        $rasis        = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Valid Rasi IDs
        $starsList    = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; // Valid Star IDs
        $laknames     = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Valid Laknam IDs
        $dosams       = ['No','Yes','Partial'];
        $interests    = [
            'Reading books and classical music lover',
            'Cooking, traveling and watching movies',
            'Cricket, yoga and technology enthusiast',
            'Gardening, drawing and classical dance',
            'Trekking, photography and cooking',
            'Music, art and volunteering in social activities',
        ];
        $fatherOccupations = ['Farmer','Government Employee','Business','Retired','Private Employee','Doctor'];
        $motherOccupations = ['Homemaker','Teacher','Government Employee','Private Employee','Business','Nurse'];

        // ─── Generate 50 users ────────────────────────────────────────
        $users = [];
        $year  = date('y');
        $month = date('m');
        $maxId = DB::table('registers')->max('id') ?? 0;

        for ($i = 1; $i <= 50; $i++) {
            $isMale  = $i <= 25;
            $gender  = $isMale ? 'Male' : 'Female';
            $nameIdx = ($i - 1) % 25; // 0–24

            $name       = $isMale ? $maleNames[$nameIdx]  : $femaleNames[$nameIdx];
            $fatherName = $fatherNames[$nameIdx];
            $motherName = $motherNames[$nameIdx];

            // DOB: age 22–40
            $age = rand(22, 40);
            $dob = Carbon::now()->subYears($age)->subDays(rand(0, 365))->format('Y-m-d');

            // Unique mobile & email
            $mobile = '9' . str_pad(rand(100000000, 999999999), 9, '0', STR_PAD_LEFT);
            $email  = strtolower(str_replace(' ', '.', $name)) . $i . '@gmail.com';

            // Varan ID
            $invID   = 11110 + $maxId + $i;
            $varanId = 'V' . $year . $month . $invID;

            $district = $districts[array_rand($districts)];
            $ed       = $educations[array_rand($educations)];
            $college  = $colleges[array_rand($colleges)];
            $job      = $jobDetails[array_rand($jobDetails)];
            $jobLoc   = $jobLocations[array_rand($jobLocations)];
            $income   = $incomes[array_rand($incomes)];
            $caste    = $castes[array_rand($castes)];
            
            // Fetch valid subcaste for this caste
            $validSubcaste = DB::table('subcastes')->where('Category_name', $caste)->inRandomOrder()->first();
            $subcasteId = $validSubcaste ? $validSubcaste->id : 1;

            $users[] = [
                'varan_id'          => $varanId,
                'Name'              => $name,
                'mobile_no'         => $mobile,
                'email_id'          => $email,
                'password'          => Hash::make('Password@123'),
                'Gender'            => $gender,
                'dob'               => $dob,
                'age'               => $age,
                'looking_for'       => $isMale ? 2 : 1,
                'created_for'       => 'Myself',
                'height'            => $heights[array_rand($heights)],
                'body_type'         => $bodyTypes[array_rand($bodyTypes)],
                'complexion'        => $complexions[array_rand($complexions)],
                'blood_group'       => $bloodGroups[array_rand($bloodGroups)],
                'physical_status'   => 'Normal',
                'marital_status'    => $maritalStats[array_rand($maritalStats)],
                'eating_habit'      => $eatingHabits[array_rand($eatingHabits)],
                'Religion'          => 1, // Force Hindu to avoid missing castes
                'Caste'             => $caste,
                'sub_caste'         => $subcasteId,
                'Monther_tongue'    => 'Tamil',
                'birth_time'        => sprintf('%02d:%02d:00', rand(0,23), rand(0,59)),
                'stars'             => $starsList[array_rand($starsList)],
                'rasi'              => $rasis[array_rand($rasis)],
                'laknam'            => $laknames[array_rand($laknames)],
                'dosam'             => $dosams[array_rand($dosams)],
                'country'           => 101,
                'state'             => 514,
                'district'          => $district,
                'eduction'          => $ed,
                'eduction_detail'   => $college,
                'job_category'      => rand(1, 14),
                'job_detail'        => $job,
                'job_location'      => $jobLoc,
                'annual_income'     => $income,
                'father_name'       => $fatherName,
                'father_occuption'  => $fatherOccupations[array_rand($fatherOccupations)],
                'mother_name'       => $motherName,
                'mother_occuption'  => $motherOccupations[array_rand($motherOccupations)],
                'total_sibblings'   => rand(0, 3),
                'elder_sister'      => rand(0, 1),
                'younger_sister'    => rand(0, 1),
                'elder_brother'     => rand(0, 1),
                'younger_brother'   => rand(0, 1),
                'about_myself'      => $interests[array_rand($interests)],
                'interests'         => $interests[array_rand($interests)],
                'status'            => 1,
                'member_shiptype'   => 0,
                'user_token'        => bin2hex(random_bytes(30)),
                'cprivacy_setting'  => 'None',
                'bprivacy_setting'  => 'None',
                'account_setting'   => 'view',
                'brokerid'          => '0',
                'blockstatus'       => 0,
                'created_at'        => Carbon::now()->subDays(rand(1, 90)),
                'updated_at'        => now(),
            ];
        }

        // ─── Bulk insert ──────────────────────────────────────────────
        $chunks = array_chunk($users, 10);
        foreach ($chunks as $chunk) {
            DB::table('registers')->insert($chunk);
        }

        // ─── Partners preference rows ─────────────────────────────────
        $inserted = DB::table('registers')
            ->orderBy('id', 'desc')
            ->limit(50)
            ->get(['varan_id', 'Religion', 'Caste', 'sub_caste']);

        foreach ($inserted as $u) {
            $exists = DB::table('partners')->where('varan_id', $u->varan_id)->exists();
            if (!$exists) {
                DB::table('partners')->insert([
                    'varan_id'             => $u->varan_id,
                    'preference_religion'  => $u->Religion,
                    'preference_caste'     => $u->Caste,
                    'preference_subcaste'  => $u->sub_caste,
                    'created_at'           => now(),
                    'updated_at'           => now(),
                ]);
            }
        }

        $this->command->info('✅ 50 Tamil users seeded successfully with partner preferences!');
    }
}
