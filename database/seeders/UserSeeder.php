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
                'role' => 'admin',
                'is_approved' => true,
            ]
        );

        // Penulis
        User::updateOrCreate(
            ['email' => 'penulis@ayakajosei.com'],
            [
                'name' => 'Penulis Ayaka',
                'password' => Hash::make('password'),
                'role' => 'penulis',
                'is_approved' => true,
            ]
        );

        // Sample User (Pending)
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'Sample User',
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_approved' => false,
            ]
        );
    }
}
