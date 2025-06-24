<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReservasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservasis')->insert([
            [
                'servis' => 'Home Service',
                'namaLengkap' => 'Andi Wijaya',
                'alamatLengkap' => 'Jl. Melati No. 10, Yogyakarta',
                'noTelp' => '08123456789',
                'idJenisKerusakan' => 1,
                'deskripsi' => 'Baterai tidak mengisi daya sama sekali',
                'gambar' => 'baterai_rusak.jpg',
                'video' => 'baterai_rusak.mp4',
                'noResi' => Str::upper(Str::random(10)),
                'status' => 'Menunggu Konfirmasi',
                'longitude' => '110.3671',
                'latitude' => '-7.7819',
                'total_harga' => 320000,
                'biaya_perjalanan' => 20000,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(1),
            ],
            [
                'servis' => 'Bawa ke Bengkel',
                'namaLengkap' => 'Siti Aminah',
                'alamatLengkap' => 'Jl. Kenanga No. 8, Sleman',
                'noTelp' => '08987654321',
                'idJenisKerusakan' => 2,
                'deskripsi' => 'Motor terasa berat saat jalan',
                'gambar' => 'dinamo_error.jpg',
                'video' => null,
                'noResi' => Str::upper(Str::random(10)),
                'status' => 'Sedang Diproses',
                'longitude' => '110.3700',
                'latitude' => '-7.8000',
                'total_harga' => 500000,
                'biaya_perjalanan' => 0,
                'created_at' => now()->subDays(1),
                'updated_at' => now(),
            ]
        ]);
    }
}
