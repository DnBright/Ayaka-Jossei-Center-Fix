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
                    'hero_title' => 'Selamat Datang di Ayaka Josei Center',
                    'hero_subtitle' => 'Ruang belajar dan berkembang bersama.',
                ],
            ],
            [
                'title' => 'Program',
                'slug' => 'program',
                'content' => [
                    'section_title' => 'Program Unggulan',
                    'section_description' => 'Daftar program pembelajaran dan kegiatan Ayaka.',
                ],
            ],
            [
                'title' => 'About',
                'slug' => 'about',
                'content' => [
                    'section_title' => 'Tentang Kami',
                    'section_description' => 'Ayaka Josei Center mendukung edukasi dan pemberdayaan.',
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
