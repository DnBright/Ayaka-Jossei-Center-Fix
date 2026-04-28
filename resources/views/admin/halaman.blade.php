@extends('layouts.admin')

@section('page-title', 'Manajemen Konten Halaman')

@section('content')
<div class="page-manager-container">
    <div class="mb-12">
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Manajemen Konten Halaman</h1>
        <p class="text-slate-500 font-medium mt-1">Pilih dan modifikasi konten visual maupun tekstual pada setiap halaman website.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $pages = [
                ['id' => 'hero', 'title' => 'Home (Beranda)', 'desc' => 'Headline, Subheadline, CTA', 'path' => '/admin/halaman/home', 'icon' => 'home'],
                ['id' => 'tentang', 'title' => 'Tentang Ayaka', 'desc' => 'Visi, Misi, Nilai Lembaga', 'path' => '/admin/halaman/about', 'icon' => 'info'],
                ['id' => 'program', 'title' => 'Program', 'desc' => 'Daftar Program & Kurikulum', 'path' => '/admin/halaman/program', 'icon' => 'book-open'],
                ['id' => 'galeri', 'title' => 'Galeri', 'desc' => 'Foto & Video Kegiatan', 'path' => '/admin/halaman/gallery', 'icon' => 'image'],
                ['id' => 'blog', 'title' => 'Blog / Artikel', 'desc' => 'Berita & Artikel Terkini', 'path' => '/admin/halaman/blog', 'icon' => 'file-text'],
                ['id' => 'alumni', 'title' => 'Alumni', 'desc' => 'Data Alumni & Testimoni', 'path' => '/admin/halaman/alumni', 'icon' => 'users'],
                ['id' => 'kontak', 'title' => 'Kontak', 'desc' => 'Informasi Kontak & Lokasi', 'path' => '/admin/halaman/contact', 'icon' => 'phone'],
            ];
        @endphp

        @foreach($pages as $page)
            <a href="{{ $page['path'] }}" class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all flex items-center gap-6 group relative overflow-hidden">
                <div class="w-16 h-16 bg-red-50 text-[#da291c] rounded-2xl flex items-center justify-center group-hover:bg-[#da291c] group-hover:text-white transition-all shadow-sm">
                    <i data-lucide="{{ $page['icon'] }}" class="w-7 h-7"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-black text-slate-900 mb-1 group-hover:text-[#da291c] transition-colors">{{ $page['title'] }}</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">{{ $page['desc'] }}</p>
                </div>
                <div class="text-slate-200 group-hover:text-[#da291c] transition-all -translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100">
                    <i data-lucide="chevron-right" class="w-6 h-6"></i>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
