<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        $alumni = [
            [
                'name' => 'Siti Rohmah',
                'batch' => 'Batch 8',
                'working_at' => 'Tokyo, Japan (Kaigo)',
                'testimonial' => 'Terima kasih Ayaka Josei Center, berkat pelatihan yang intensif saya bisa berkarir di Tokyo sekarang.',
                'is_featured' => true
            ],
            [
                'name' => 'Dewi Sartika',
                'batch' => 'Batch 10',
                'working_at' => 'Osaka, Japan (Food Service)',
                'testimonial' => 'Programnya sangat membantu, terutama dalam persiapan bahasa dan mental untuk bekerja di luar negeri.',
                'is_featured' => true
            ],
        ];

        foreach ($alumni as $a) {
            Alumni::updateOrCreate(['name' => $a['name']], $a);
        }
    }
}
