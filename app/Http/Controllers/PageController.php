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
                    'hero_bg' => 'images/hero-bg.png',
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
                    'hero_subtitle' => 'Kurikulum intensif yang dirancang untuk memenuhi standar kompetensi kerja di Jepang.',
                    'pengantar_title' => 'Membangun Keterampilan Yang Relevan Dengan Industri Jepang',
                    'pengantar_subtitle' => 'Setiap program di AJC didukung oleh instruktur berpengalaman dan kurikulum yang diperbarui secara berkala sesuai regulasi ketenagakerjaan Jepang.',
                    'cta_title' => 'Siap Memulai Karirmu?',
                    'cta_description' => 'Dapatkan bimbingan langsung dari konsultan kami mengenai alur pendaftaran dan biaya pelatihan.',
                ],
            ],
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'content' => [
                    'hero_title' => 'Kemitraan & Konsultasi',
                    'hero_subtitle' => 'Kami siap membantu Anda memulai perjalanan karir profesional di Jepang. Hubungi tim kami untuk konsultasi gratis.',
                    'form_title' => 'Kirim Pesan',
                    'form_subtitle' => 'Tim kami biasanya merespon dalam waktu kurang dari 24 jam.',
                    'footer_quote' => 'Mari Bergabung Bersama Ribuan Alumni Sukses Kami',
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

        $content = $request->content;

        // Handle File Uploads for Image Keys
        if ($request->hasFile('content_files')) {
            foreach ($request->file('content_files') as $key => $file) {
                if ($file->isValid()) {
                    $path = $file->store('pages', 'public');
                    $content[$key] = \Illuminate\Support\Facades\Storage::url($path);
                }
            }
        }

        $page->update([
            'content' => $content
        ]);

        return back()->with('success', 'Konten halaman berhasil diperbarui.');
    }
}
