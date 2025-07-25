<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user admin default
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@selismolishoki.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Buat user teknisi contoh
        User::create([
            'name' => 'Teknisi 1',
            'email' => 'teknisi@selismolishoki.com',
            'password' => Hash::make('password'),
            'role' => 'teknisi',
        ]);

        // Buat user owner contoh
        User::create([
            'name' => 'Owner',
            'email' => 'owner@selismolishoki.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);
    }
}
