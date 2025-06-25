<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UlasanSeeder::class);
        $this->call(JenisKerusakanSeeder::class);
        $this->call(ReservasiSeeder::class);
        $this->call(RiwayatSeeder::class);
        // Create an admin user
        \App\Models\Setting::updateOrCreate([
            'key' => 'bengkel_longlat'
        ], [
            'value' => '109.264502,-7.437347'
        ]);
        \App\Models\Setting::updateOrCreate([
            'key' => 'tarif_per_km'
        ], [
            'value' => '5000'
        ]);
    }
}
