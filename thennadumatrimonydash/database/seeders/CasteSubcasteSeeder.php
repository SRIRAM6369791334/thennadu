<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasteSubcasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('subcastes')->truncate();
        DB::table('castes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            'Adidravidar' => ['Paraiyar', 'Madiga', 'Others'],
            'Brahmin - Iyer' => ['Brahmacharanam', 'Vadama', 'Vathima', 'Ashtasahasram', 'Gurukkal', 'Others'],
            'Brahmin - Iyengar' => ['Vadakalai', 'Thenkalai', 'Others'],
            'Chettiar' => ['Nattukottai Chettiar', 'Arya Vysya Chettiar', 'Berichettiar', 'Devanga Chettiar', 'Gandla Chettiar', 'Vaniya Chettiar', 'Saiva Chettiar', 'Others'],
            'Gounder' => ['Kongu Vellala Gounder', 'Anuppa Gounder', 'Kurumba Gounder', 'Vettaiya Gounder', 'Others'],
            'Mudaliar' => ['Agamudaya Mudaliar', 'Arcot Mudaliar', 'Sengunthar Mudaliar', 'Thuluva Vellala Mudaliar', 'Isai Vellalar', 'Others'],
            'Nadar' => ['Nadar', 'Others'],
            'Naidu' => ['Gavara Naidu', 'Kamma Naidu', 'Balija Naidu', 'Vaduga Naidu', 'Others'],
            'Pillai' => ['Saiva Pillai', 'Tirunelveli Pillai', 'Sozhia Pillai', 'Karkathar Pillai', 'Nanchil Pillai', 'Others'],
            'Thevar / Mukkulathor' => ['Agamudayar', 'Kallar', 'Maravar', 'Others'],
            'Vanniyar' => ['Vanniyar', 'Padayachi', 'Gounder', 'Palli', 'Others'],
            'Vishwakarma' => ['Kammalar', 'Goldsmith', 'Blacksmith', 'Carpenter', 'Others'],
            'Yadava' => ['Konar', 'Yadava (General)', 'Others'],
            'Muthuraja' => ['Muthiriyar', 'Ambalakarar', 'Others'],
            'Devangar' => ['Kannada Devangar', 'Telugu Devangar', 'Others'],
            'Sengunthar' => ['Sengunthar (General)', 'Others'],
            'Reddiar' => ['Reddiar', 'Others'],
            'Moopanar' => ['Moopanar', 'Others'],
            'Udayar' => ['Nathaman Udayar', 'Malaiman Udayar', 'Sudharman Udayar', 'Others'],
            'Veera Saiva' => ['Veera Saiva', 'Others'],
            'Sourashtra' => ['Sourashtra', 'Others'],
            'Vanniakula Kshatriyar' => ['Vanniakula Kshatriyar', 'Others'],
        ];

        foreach ($data as $casteName => $subcastes) {
            $casteId = DB::table('castes')->insertGetId([
                'Caste_name' => $casteName,
                'religion' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($subcastes as $subcasteName) {
                DB::table('subcastes')->insert([
                    'Category_name' => $casteId,
                    'subcategory_name' => $subcasteName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

