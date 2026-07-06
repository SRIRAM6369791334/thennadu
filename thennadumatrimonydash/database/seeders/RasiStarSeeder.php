<?php
$mappings = [
    1 => [1, 2, 3],
    2 => [3, 4, 5],
    3 => [5, 6, 7],
    4 => [7, 8, 9],
    5 => [10, 11, 12],
    6 => [12, 13, 14],
    7 => [14, 15, 16],
    8 => [16, 17, 18],
    9 => [19, 20, 21],
    10 => [21, 22, 23],
    11 => [23, 24, 25],
    12 => [25, 26, 27]
];

DB::table('rasi_star')->truncate();

$inserts = [];
foreach ($mappings as $rasi_id => $stars) {
    foreach ($stars as $star_id) {
        $inserts[] = [
            'rasi_id' => $rasi_id,
            'star_id' => $star_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
DB::table('rasi_star')->insert($inserts);
echo "Inserted " . count($inserts) . " mappings successfully.\n";
