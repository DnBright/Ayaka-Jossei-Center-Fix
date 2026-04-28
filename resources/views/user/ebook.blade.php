@extends('layouts.app')

@section('title', 'E-Book - Ayaka Josei Center')

@section('content')
<div class="ebook-page-wrapper bg-slate-50 min-h-screen pt-20">
    <!-- E-Book Hero -->
    <header class="bg-white border-b border-slate-100 py-16 md:py-24">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl reveal-up">
                <span class="inline-block bg-[#da291c]/10 text-[#da291c] px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-6">
                    Resources Archive
                </span>
                <h1 class="text-4xl md:text-7xl font-black text-slate-950 tracking-tighter uppercase italic leading-none mb-8">
                    E-Book <br /> <span class="text-slate-400">Edukasi</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-500 leading-relaxed max-w-2xl mb-12">
                    Kumpulan materi pembelajaran bahasa Jepang, panduan karir, dan informasi budaya yang dirancang khusus untuk mempersiapkan keberangkatan Anda.
                </p>

                <!-- Search -->
                <form action="{{ route('ebook.index') }}" method="GET" class="max-w-xl relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul e-book atau materi..." class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-12 py-5 font-bold text-slate-900 focus:outline-none focus:border-[#da291c] focus:bg-white transition-all shadow-sm">
                    <svg class="w-6 h-6 text-[#da291c] absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 bg-slate-900 text-white px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#da291c] transition-colors">Cari</button>
                </form>
            </div>
        </div>
    </header>

    <!-- E-Book List -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-6">
            <div class="flex items-center gap-6 mb-12 md:mb-16 reveal-up">
                <h2 class="text-2xl md:text-3xl font-black text-slate-900 uppercase tracking-tighter italic">Arsip Materi</h2>
                <div class="h-px flex-1 bg-slate-200"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($ebooks as $idx => $book)
                    @php
                        $coverImage = str_starts_with($book->cover_image ?? '', 'http')
                            ? $book->cover_image
                            : (str_starts_with($book->cover_image ?? '', 'images/')
                                ? asset($book->cover_image)
                                : (str_starts_with($book->cover_image ?? '', 'ebooks/covers/')
                                    ? Storage::url($book->cover_image)
                                    : asset('images/hero-bg.png')));
                    @endphp
                    <div class="bg-white rounded-[40px] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 reveal-up overflow-hidden group" style="animation-delay: {{ $idx * 0.1 }}s">
                        <!-- Cover Image -->
                        <div class="aspect-[4/3] relative overflow-hidden bg-slate-100">
                            <img src="{{ $coverImage }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $book->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                                <div class="text-white">
                                    <div class="text-[10px] font-black uppercase tracking-[0.2em] mb-2">Metadata</div>
                                    <div class="text-xs font-bold text-slate-300">Format: PDF • Size: 2.4 MB</div>
                                </div>
                            </div>
                            @if($book->created_at->diffInDays(now()) < 7)
                                <span class="absolute top-6 left-6 bg-[#da291c] text-white px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-widest shadow-lg shadow-red-900/40 animate-pulse">New</span>
                            @endif
                        </div>

                        <div class="p-8 md:p-10">
                            <div class="flex items-center justify-between gap-4 mb-6">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                    <svg class="w-3 h-3 text-[#da291c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>
                                    {{ number_format($book->download_count) }} Downloads
                                </span>
                                <span class="text-[10px] font-black text-[#da291c] uppercase tracking-widest bg-[#da291c]/5 px-3 py-1 rounded-lg">Materi AJC</span>
                            </div>

                            <h3 class="text-xl md:text-2xl font-black text-slate-900 mb-4 tracking-tighter uppercase italic leading-none group-hover:text-[#da291c] transition-colors">{{ $book->title }}</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-8 line-clamp-2 font-medium">{{ $book->description }}</p>
                            
                            <a href="{{ route('ebook.download', $book->id) }}" class="w-full bg-slate-950 text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-3 hover:bg-[#da291c] transition-all shadow-xl shadow-slate-900/10">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Unduh Materi (PDF)
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400">Belum ada e-book tersedia.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center reveal-up">
                {{ $ebooks->links() }}
            </div>
        </div>
    </section>

    <!-- Warning / Footer Section -->
    <section class="pb-24">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto bg-white border border-red-100 border-l-4 border-l-[#da291c] p-8 md:p-10 rounded-2xl flex flex-col md:flex-row items-start gap-6 reveal-up">
                <div class="w-12 h-12 bg-red-50 text-[#da291c] rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-lg font-black text-slate-900 mb-2 uppercase italic tracking-tight">Perhatian Hak Cipta</h4>
                    <p class="text-slate-500 text-sm md:text-base leading-relaxed">Seluruh materi e-book di atas adalah milik eksklusif Ayaka Josei Center. Dilarang keras menyebarluaskan, memperjualbelikan, atau mengubah konten tanpa izin tertulis dari pihak manajemen AJC.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .reveal-up {
        opacity: 0;
        transform: translateY(30px);
        animation: revealUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes revealUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
