<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

class PageController extends Controller
{
    private function ensureDefaultPages(): void
    {
        $defaults = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'content' => [
                    'hero_title' => 'Ayaka Josei Center',
                    'hero_subtitle' => 'Lembaga Pelatihan Kerja (LPK) Khusus Putri untuk Karir Profesional di Jepang.',
                    'stats_1_value' => '500+',
                    'stats_1_label' => 'Alumni Berangkat',
                    'stats_2_value' => '98%',
                    'stats_2_label' => 'Lulus Interview',
                    'stats_3_value' => '20+',
                    'stats_3_label' => 'Partner User',
                    'stats_4_value' => '24/7',
                    'stats_4_label' => 'Dukungan Alumni',
                    'about_title' => 'Membangun Masa Depan di Jepang',
                    'about_description' => 'Ayaka Josei Center adalah lembaga pelatihan kerja spesialis putri yang berfokus pada pengembangan karir di Jepang. Kami memberikan pelatihan intensif bahasa dan keterampilan teknis untuk mencetak tenaga kerja profesional yang siap bersaing di pasar global.',
                    'cta_title' => 'Siap Menjadi Bagian Dari Kesuksesan Kami?',
                    'cta_description' => 'Pendaftaran batch baru telah dibuka. Hubungi kami untuk konsultasi gratis mengenai karirmu di Jepang.',
                ],
            ],
            [
                'title' => 'About',
                'slug' => 'about',
                'content' => [
                    'hero_title' => 'Dedikasi Kami Untuk Masa Depan Perempuan Indonesia',
                    'hero_subtitle' => 'Ayaka Josei Center adalah jembatan profesional menuju karir gemilang di Jepang.',
                    'pengantar_title' => 'Pengantar',
                    'pengantar_text' => 'Ayaka Josei Center (AJC) adalah Lembaga Pelatihan Kerja (LPK) yang secara khusus didirikan untuk mempersiapkan perempuan Indonesia agar mampu bersaing secara profesional di Jepang.',
                    'latar_belakang_title' => 'Latar Belakang',
                    'latar_belakang_text' => 'Bermula dari keinginan untuk memberikan perlindungan dan edukasi yang benar bagi calon tenaga kerja perempuan, AJC hadir dengan sistem yang transparan.',
                    'visi_text' => 'Menjadi lembaga pelatihan terdepan dalam mencetak perempuan Indonesia yang mandiri, berkarakter, dan ahli di bidangnya untuk pasar kerja internasional.',
                    'misi_1' => 'Menyelenggarakan pelatihan bahasa Jepang yang intensif dan efektif.',
                    'misi_2' => 'Membangun mentalitas kerja profesional sesuai standar industri Jepang.',
                    'misi_3' => 'Memberikan pendampingan karir yang transparan dan akuntabel.',
                    'misi_4' => 'Menjamin keamanan dan kenyamanan peserta selama proses pelatihan hingga penempatan.',
                ],
            ],
            [
                'title' => 'Program',
                'slug' => 'program',
                'content' => [
                    'hero_title' => 'Program Pelatihan Unggulan',
                    'hero_subtitle' => 'Persiapkan diri Anda dengan keterampilan teknis dan bahasa terbaik.',
                ],
            ],
        ];

        foreach ($defaults as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                [
                    'title' => $page['title'],
                    'content' => $page['content'],
                ]
            );
        }
    }

    public function index()
    {
        $this->ensureDefaultPages();
        $pages = Page::all();
        return view('admin.halaman', compact('pages'));
    }

    public function edit($slug)
    {
        $this->ensureDefaultPages();
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('admin.halaman_edit', compact('page'));
    }

    public function update(Request $request, $slug)
    {
        $this->ensureDefaultPages();
        $page = Page::where('slug', $slug)->firstOrFail();
        
        $request->validate([
            'content' => 'required|array',
        ]);

        $page->update([
            'content' => $request->content
        ]);

        return back()->with('success', 'Konten halaman berhasil diperbarui.');
    }
}
