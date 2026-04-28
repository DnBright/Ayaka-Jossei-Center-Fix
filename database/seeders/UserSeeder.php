<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Baru
        User::updateOrCreate(
            ['email' => 'admin.utama@ayakajosei.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('AyakaAdmin2026!'),
                'role' => 'admin',
                'is_approved' => true,
            ]
        );

        // Penulis Baru
        User::updateOrCreate(
            ['email' => 'author.pro@ayakajosei.com'],
            [
                'name' => 'Ayaka Author',
                'password' => Hash::make('PenulisHebat26!'),
                'role' => 'penulis',
                'is_approved' => true,
            ]
        );

        // User Member Baru (Langsung Aktif/Approved)
        User::updateOrCreate(
            ['email' => 'member.vip@gmail.com'],
            [
                'name' => 'Member VIP',
                'password' => Hash::make('MemberAyaka2026!'),
                'role' => 'user',
                'is_approved' => true,
            ]
        );
    }

}
