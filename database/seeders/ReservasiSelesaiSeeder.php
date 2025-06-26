<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// database/seeders/ReservasiSelesaiSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Reservasi;

class ReservasiSelesaiSeeder extends Seeder
{
    public function run(): void
    {
        Reservasi::create([
            'servis' => 'Service Umum',
            'namaLengkap' => 'Dummy User',
            'alamatLengkap' => 'Jl. Contoh No. 123',
            'noTelp' => '085861466287', // harus sesuai dengan user login
            'idJenisKerusakan' => 1, // pastikan ini ada
            'deskripsi' => 'Testing garansi',
            'gambar' => null,
            'video' => null,
            'noResi' => 'HM-TEST123',
            'status' => 'completed',
            'longitude' => '-6.200000',
            'latitude' => '106.816666',
            'kendaraan_id' => null,
            'total_harga' => 100000,
            'biaya_perjalanan' => 5000,
            'tanggal_berakhir_garansi' => now()->addDays(10),
        ]);
    }
}
