<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisKerusakanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jenis_kerusakans')->insert([
            [
                'nama' => 'Kerusakan Baterai',
                'biaya_estimasi' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kerusakan Dinamo',
                'biaya_estimasi' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kerusakan Rem',
                'biaya_estimasi' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
