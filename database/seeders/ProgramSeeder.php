<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Tokutei Ginou (Kaigo)',
                'description' => 'Program pelatihan pengasuh lansia untuk bekerja di Jepang dengan kontrak 5 tahun.',
                'icon' => 'heart',
                'curriculum' => ['Bahasa Jepang Dasar', 'Teknik Kaigo', 'Budaya Kerja Jepang']
            ],
            [
                'title' => 'Tokutei Ginou (Food Service)',
                'description' => 'Program industri pengolahan makanan dan manajemen restoran di Jepang.',
                'icon' => 'utensils',
                'curriculum' => ['Higiene Makanan', 'Layanan Pelanggan', 'Bahasa Jepang Industri']
            ],
            [
                'title' => 'Magang (Ginou Jisshu)',
                'description' => 'Program pemagangan teknis di berbagai sektor industri manufaktur Jepang.',
                'icon' => 'cog',
                'curriculum' => ['Kesehatan & Keselamatan Kerja', 'Etos Kerja', 'Komunikasi Dasar']
            ],
        ];

        foreach ($programs as $prog) {
            Program::updateOrCreate(
                ['slug' => Str::slug($prog['title'])],
                [
                    'title' => $prog['title'],
                    'description' => $prog['description'],
                    'icon' => $prog['icon'],
                    'curriculum' => $prog['curriculum'],
                    'is_active' => true,
                ]
            );
        }
    }
}
