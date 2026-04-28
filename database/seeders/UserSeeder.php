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
            ['email' => 'admin@ayakajosei.com'],
            [
                'name' => 'Admin Ayaka',
                'password' => Hash::make('password'),
            ]
        );

        // Penulis
        User::updateOrCreate(
            ['email' => 'penulis@ayakajosei.com'],
            [
                'name' => 'Penulis Ayaka',
                'password' => Hash::make('password'),
            ]
        );
    }
}
