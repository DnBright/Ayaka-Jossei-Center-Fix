@extends('layouts.app')

@section('title', 'Galeri Kegiatan & Fasilitas Pelatihan | Ayaka Josei Center')
@section('meta_title', 'Galeri Kegiatan & Fasilitas Pelatihan | Ayaka Josei Center')
@section('meta_description', 'Galeri foto dan dokumentasi kegiatan pelatihan, fasilitas asrama, dan momen keberangkatan siswa Ayaka Josei Center ke Jepang.')
@section('meta_keywords', 'galeri LPK jepang, foto kegiatan magang jepang, asrama LPK jepang, fasilitas ayaka josei center, dokumentasi berangkat jepang')
@section('canonical', url('/galeri'))

@section('content')
<div class="atelier-wrapper">
    <!-- 1. ATELIER HERO -->
    <header class="atelier-hero py-16 md:py-32 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-24 items-center lg:items-end relative z-10">
                <div class="hero-meta atelier-reveal text-center lg:text-left">
                    <span class="text-[#da291c] font-black tracking-[0.4em] text-[10px] mb-8 block uppercase">Captured Moments</span>
                    <h1 class="text-4xl md:text-7xl lg:text-[100px] leading-[0.95] md:leading-[0.85] font-black text-slate-900 tracking-tighter uppercase italic">
                        Galeri <br /> <span class="font-['Cormorant_Garamond'] italic text-[#da291c] normal-case">Kegiatan</span>
                    </h1>
                </div>
                <div class="hero-intro-box atelier-reveal mt-12 lg:mt-0 text-center lg:text-left">
                    <div class="w-16 h-1 bg-[#da291c] mb-8 mx-auto lg:mx-0"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-6 tracking-tight italic uppercase leading-none">Dokumentasi Jejak Karir & Pelatihan</h2>
                    <p class="text-lg md:text-xl text-slate-500 leading-relaxed max-w-md mx-auto lg:mx-0">Kumpulan momen inspiratif dari proses pelatihan, keberangkatan, hingga keseharian alumni kami di Jepang.</p>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-[40%] h-full bg-slate-50 -z-0 hidden lg:block"></div>
    </header>

    <!-- 2. FILTER & CATEGORIES -->
    <nav class="bg-white border-y border-slate-100 py-4 md:py-6">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-slate-900">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter Galeri
                </div>
                <div class="flex flex-wrap gap-3 justify-center">
                    @php
                        $categories = [
                            ['id' => 'all', 'label' => 'Semua'],
                            ['id' => 'pelatihan', 'label' => 'Pelatihan'],
                            ['id' => 'interview', 'label' => 'Wawancara'],
                            ['id' => 'keberangkatan', 'label' => 'Keberangkatan'],
                            ['id' => 'alumni', 'label' => 'Alumni di Jepang']
                        ];
                    @endphp
                    @foreach($categories as $cat)
                        <a href="{{ route('galeri.index', ['type' => $cat['id']]) }}" class="px-4 md:px-6 py-2 rounded-full border border-slate-200 text-[9px] md:text-xs font-black uppercase tracking-widest hover:border-[#da291c] hover:text-[#da291c] transition-all {{ request('type', 'all') == $cat['id'] ? 'bg-slate-900 text-white border-slate-900' : '' }}">
                            {{ $cat['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </nav>

    <!-- 3. PHOTO GRID - MASONRY STYLE -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-6">
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-8 md:gap-10 space-y-8 md:space-y-10">
                @forelse($galleryItems as $i => $item)
                    @php
                        $imageSource = str_starts_with($item->file_path ?? '', 'http')
                            ? $item->file_path
                            : asset($item->file_path);
                    @endphp
                    <div class="break-inside-avoid atelier-reveal group">
                        <div class="relative rounded-[25px] overflow-hidden shadow-xl bg-slate-100 mb-6">
                            <img src="{{ $imageSource }}" class="w-full grayscale group-hover:grayscale-0 transition-all duration-1000 group-hover:scale-105" alt="Gallery Image">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 md:p-10 flex flex-col justify-end">
                                <span class="text-[#da291c] text-[10px] font-black uppercase tracking-widest mb-2">{{ $item->type ?? 'Gallery' }}</span>
                                <h3 class="text-white text-xl md:text-2xl font-black italic tracking-tighter leading-none uppercase">{{ $item->title }}</h3>
                            </div>
                        </div>
                        <div class="border-l border-slate-200 pl-6 mt-4">
                            <span class="text-[10px] font-black opacity-20 block mb-1">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="text-xs md:text-sm font-bold text-slate-800 uppercase tracking-tight leading-snug">{{ $item->title }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400">Belum ada data galeri.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-20 flex justify-center atelier-reveal">
                {{ $galleryItems->links() }}
            </div>
        </div>
    </section>

    <!-- 4. VIDEO SHOWCASE -->
    <section class="py-20 md:py-32 bg-slate-950 text-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 md:mb-24 atelier-reveal">
                <span class="text-[#da291c] font-black tracking-[0.4em] text-[10px] mb-6 block uppercase">Video Showcase</span>
                <h2 class="text-4xl md:text-5xl lg:text-7xl font-black tracking-tighter uppercase italic leading-none">Dokumentasi Visual</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16">
                @for($i = 1; $i <= 2; $i++)
                    <div class="atelier-reveal flex flex-col gap-8 md:gap-10 group text-center md:text-left">
                        <div class="aspect-video bg-slate-900 rounded-[25px] md:rounded-[30px] relative overflow-hidden cursor-pointer">
                            <div class="absolute inset-0 bg-cover bg-center grayscale opacity-40 group-hover:scale-110 transition-transform duration-1000" style="background-image: url('{{ asset('images/hero-bg.png') }}')"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-16 h-16 md:w-20 md:h-20 bg-white rounded-full flex items-center justify-center text-slate-950 shadow-2xl group-hover:bg-[#da291c] group-hover:text-white transition-all transform group-hover:scale-110">
                                    <svg class="w-7 h-7 md:w-8 md:h-8 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl md:text-3xl font-black mb-4 tracking-tighter italic uppercase leading-none">Vlog Keberangkatan Alumni</h3>
                            <p class="text-sm md:text-lg text-slate-500 leading-relaxed mb-8">Mengikuti perjalanan peserta dari asrama pelatihan hingga menginjakkan kaki pertama kali di Narita Airport.</p>
                            <button class="text-[#da291c] font-black uppercase tracking-widest text-[9px] flex items-center justify-center md:justify-start gap-4 hover:gap-6 transition-all mx-auto md:mx-0">
                                Watch Full Film <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </button>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- 5. PENUTUP -->
    <footer class="py-20 md:py-32 text-center">
        <div class="container mx-auto px-6 flex flex-col items-center">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-slate-900 text-white rounded-full flex items-center justify-center text-3xl md:text-4xl font-black mb-10 md:mb-12 atelier-reveal">A</div>
            <p class="text-xl md:text-2xl text-slate-500 italic max-w-xl mb-12 atelier-reveal leading-relaxed px-4">"Setiap foto bercerita tentang kerja keras, harapan, dan masa depan yang lebih baik."</p>
            <div class="w-px h-16 md:h-24 bg-slate-100 mb-12"></div>
            <span class="text-[9px] md:text-[10px] font-black uppercase tracking-[0.4em] text-slate-200">Archive Date: April 2026</span>
        </div>
    </footer>
</div>

<style>
    .atelier-reveal {
        opacity: 0;
        transform: translateY(30px);
        animation: reveal 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes reveal {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
