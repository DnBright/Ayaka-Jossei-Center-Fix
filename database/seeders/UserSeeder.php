<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator Ayaka',
                'password' => Hash::make('password'),
            ]
        );

        // Penulis
        User::updateOrCreate(
            ['email' => 'penulis_ayaka'],
            [
                'name' => 'Penulis Ayaka',
                'password' => Hash::make('Ayaka@Penulis2026'),
            ]
        );
    }
}
