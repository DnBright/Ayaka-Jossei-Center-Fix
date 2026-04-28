<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WriterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'penulis@ayakajosei.com'], // Email unik untuk login
            [
                'name' => 'penulis_ayaka',
                'password' => Hash::make('Ayaka@Penulis2026'),
                'role' => 'penulis',
                'is_approved' => true, // Tambahkan ini agar akun langsung aktif
            ]
        );
    }
}
