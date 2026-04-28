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
                <p class="text-lg md:text-xl text-slate-500 leading-relaxed max-w-2xl">
                    Kumpulan materi pembelajaran bahasa Jepang, panduan karir, dan informasi budaya yang dirancang khusus untuk mempersiapkan keberangkatan Anda.
                </p>
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
                @php
                    $ebooks = [
                        [
                            'title' => 'Panduan Dasar Bahasa Jepang',
                            'desc' => 'Materi pengenalan Hiragana, Katakana, dan tata bahasa dasar untuk pemula.',
                            'version' => 'V1.0',
                            'category' => 'Bahasa'
                        ],
                        [
                            'title' => 'Etika Kerja di Jepang',
                            'desc' => 'Memahami budaya kerja, sopan santun, dan disiplin tinggi di perusahaan Jepang.',
                            'version' => 'V2.1',
                            'category' => 'Budaya'
                        ],
                        [
                            'title' => 'Persiapan Wawancara User',
                            'desc' => 'Tips dan trik menjawab pertanyaan wawancara langsung dengan perusahaan Jepang.',
                            'version' => 'V1.5',
                            'category' => 'Karir'
                        ],
                        [
                            'title' => 'Panduan Hidup di Jepang',
                            'desc' => 'Informasi praktis tentang transportasi, belanja, dan biaya hidup di Jepang.',
                            'version' => 'V1.2',
                            'category' => 'Life'
                        ],
                        [
                            'title' => 'Kamus Istilah Kaigo',
                            'desc' => 'Kumpulan kosakata teknis yang sering digunakan di bidang perawat lansia.',
                            'version' => 'V3.0',
                            'category' => 'Teknis'
                        ],
                        [
                            'title' => 'Panduan Keberangkatan',
                            'desc' => 'Checklist dokumen dan barang yang wajib dipersiapkan sebelum terbang.',
                            'version' => 'V1.0',
                            'category' => 'Logistik'
                        ]
                    ];
                @endphp

                @foreach($ebooks as $idx => $book)
                    <div class="bg-white p-8 md:p-10 rounded-[30px] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 reveal-up" style="animation-delay: {{ $idx * 0.1 }}s">
                        <div class="w-14 h-14 bg-[#da291c]/5 text-[#da291c] rounded-2xl flex items-center justify-center mb-8">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $book['version'] }}</span>
                            <span class="text-[10px] font-black text-[#da291c] uppercase tracking-widest bg-[#da291c]/5 px-2 py-0.5 rounded">{{ $book['category'] }}</span>
                        </div>

                        <h3 class="text-xl md:text-2xl font-black text-slate-900 mb-4 tracking-tight uppercase italic leading-none">{{ $book['title'] }}</h3>
                        <p class="text-slate-500 text-sm md:text-base leading-relaxed mb-8">{{ $book['desc'] }}</p>
                        
                        <button class="w-full bg-slate-900 text-white py-4 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-3 hover:bg-[#da291c] transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download E-Book
                        </button>
                    </div>
                @endforeach
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
