<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RiwayatSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('riwayats')->insert([
            [
                'idReservasi' => 1,
                'status' => 'Reservasi dibuat',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'idReservasi' => 1,
                'status' => 'Menunggu Konfirmasi',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'idReservasi' => 2,
                'status' => 'Reservasi diterima',
                'created_at' => now()->subDay(),
                'updated_at' => now(),
            ],
        ]);
    }
}
