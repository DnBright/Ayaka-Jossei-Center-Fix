@extends('layouts.app')

@section('title', 'Blog & Artikel - Ayaka Josei Center')

@section('content')
<div class="journal-wrapper font-['Outfit']">
    <!-- 1. JOURNAL HERO -->
    <header class="journal-hero py-16 md:py-24 border-b-2 border-slate-900 bg-white relative z-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row justify-between items-center lg:items-end gap-12">
                <div class="hero-header-min journal-reveal text-center lg:text-left">
                    <span class="text-[#da291c] font-black tracking-[0.4em] text-[10px] mb-6 block uppercase">Official Journal</span>
                    <h1 class="text-4xl md:text-6xl lg:text-[100px] font-['Playfair_Display'] font-black leading-[0.95] md:leading-[0.9] text-slate-900 tracking-tighter italic uppercase">Wawasan <br /> <span class="text-[#da291c]">Karir</span> Jepang</h1>
                </div>
                <div class="hero-brief-lux journal-reveal max-w-md text-center lg:text-left">
                    <div class="w-10 h-1 bg-[#da291c] mb-8 mx-auto lg:mx-0"></div>
                    <p class="text-lg md:text-xl text-slate-500 italic leading-relaxed">Berbagi informasi terkini mengenai dunia kerja, budaya, dan tips sukses berkarir di Negeri Sakura.</p>
                </div>
            </div>
        </div>
    </header>

    <!-- 2. SEARCH & FILTER -->
    <section class="py-12 bg-slate-50 border-b border-slate-100">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-8 journal-reveal">
                <form action="{{ route('blog.index') }}" method="GET" class="flex-1 w-full relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..." class="w-full bg-white border border-slate-200 rounded-xl px-12 py-4 font-bold text-slate-900 focus:outline-none focus:border-[#da291c] transition-all text-sm">
                    <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2">
                        <svg class="w-5 h-5 text-[#da291c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
                <div class="flex flex-wrap gap-4 justify-center">
                    @php
                        $categoryFilters = array_merge(['Semua'], $categories ?? []);
                    @endphp
                    @foreach($categoryFilters as $cat)
                        <a href="{{ route('blog.index', ['category' => $cat]) }}" class="px-4 md:px-6 py-2 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-[#da291c] transition-all {{ (request('category', 'Semua') == $cat) ? 'border-b-4 border-[#da291c] text-[#da291c]' : '' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- 3. ARTICLE LIST -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
                <!-- Featured Article -->
                @if($featuredArticle)
                    @php
                        $isFeaturedMemberOnly = $featuredArticle->is_member_only;
                        $featuredImage = str_starts_with($featuredArticle->featured_image ?? '', 'http')
                            ? $featuredArticle->featured_image
                            : ($featuredArticle->featured_image
                                ? asset($featuredArticle->featured_image)
                                : asset('images/hero-bg.png'));
                    @endphp
                    <article class="lg:col-span-2 group journal-reveal relative">
                        <a href="{{ ($isFeaturedMemberOnly && !Auth::check()) ? route('login') : route('blog.show', $featuredArticle->slug) }}" class="block">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start border-b-4 border-slate-900 pb-12 relative">
                                <div class="lg:col-span-7 rounded-lg overflow-hidden aspect-[16/10] bg-slate-100 relative">
                                    <img src="{{ $featuredImage }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000 group-hover:scale-105" alt="Featured">
                                    
                                    @if($isFeaturedMemberOnly && !Auth::check())
                                        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm flex flex-col items-center justify-center p-6 z-10">
                                            <svg class="w-12 h-12 text-white mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            <span class="text-white text-xs font-black uppercase tracking-widest text-center">Eksklusif: Login Untuk Membaca</span>
                                        </div>
                                    @endif
                                    
                                    @if($isFeaturedMemberOnly)
                                        <span class="absolute top-4 right-4 bg-[#da291c] text-white px-4 py-2 text-[10px] font-black uppercase tracking-widest z-20 flex items-center gap-2 shadow-xl">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            Member Only
                                        </span>
                                    @endif
                                </div>
                                <div class="lg:col-span-5 text-center lg:text-left relative z-10">
                                    <div class="flex justify-center lg:justify-start gap-4 mb-6 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                        <span class="flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $featuredArticle->created_at->format('M d, Y') }}</span>
                                        <span class="text-[#da291c]">{{ number_format($featuredArticle->views_count) }} Views</span>
                                    </div>
                                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-6 group-hover:text-[#da291c] transition-colors leading-tight tracking-tighter uppercase italic">{{ $featuredArticle->title }}</h2>
                                    <p class="text-base md:text-lg text-slate-500 leading-relaxed mb-8">{{ \Illuminate\Support\Str::limit(strip_tags($featuredArticle->content), 160) }}</p>
                                    <span class="text-xs font-black uppercase tracking-widest flex items-center justify-center lg:justify-start gap-3">Baca Artikel <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg></span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endif

                <!-- Regular Articles -->
                @forelse($regularArticles as $i => $article)
                    @php
                        $isMemberOnly = $article->is_member_only;
                        $articleImage = str_starts_with($article->featured_image ?? '', 'http')
                            ? $article->featured_image
                            : ($article->featured_image
                                ? asset($article->featured_image)
                                : asset('images/hero-bg.png'));
                    @endphp
                    <article class="group journal-reveal border-b border-slate-100 pb-12 text-center lg:text-left relative">
                        <a href="{{ ($isMemberOnly && !Auth::check()) ? route('login') : route('blog.show', $article->slug) }}" class="block">
                            <div class="aspect-video rounded-lg overflow-hidden mb-8 bg-slate-100 relative">
                                <img src="{{ $articleImage }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-1000" alt="Post">
                                <span class="absolute top-4 left-4 bg-[#da291c] text-white px-4 py-1 text-[8px] font-black uppercase tracking-widest">{{ $article->category->name ?? 'Kategori' }}</span>
                                
                                @if($isMemberOnly && !Auth::check())
                                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm flex flex-col items-center justify-center p-6">
                                        <svg class="w-10 h-10 text-white mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        <span class="text-white text-[10px] font-black uppercase tracking-widest text-center">Daftar Untuk Membaca</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex justify-center lg:justify-start gap-4 mb-4 text-[9px] font-black uppercase tracking-widest text-slate-400">
                                <span>{{ $article->created_at->format('M d, Y') }}</span>
                                @if($isMemberOnly)
                                    <span class="text-[#da291c] flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        Member Only
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-xl md:text-2xl font-black text-slate-900 mb-4 group-hover:text-[#da291c] transition-colors leading-tight tracking-tighter italic uppercase">{{ $article->title }}</h3>
                            
                            @if($isMemberOnly && !Auth::check())
                                <p class="text-sm text-slate-400 line-clamp-3 mb-6 leading-relaxed italic">Konten ini hanya tersedia untuk member resmi Ayaka Josei Center.</p>
                                <span class="text-[10px] font-black uppercase tracking-widest text-[#da291c] flex items-center justify-center lg:justify-start gap-2">Register to Read <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg></span>
                            @else
                                <p class="text-sm text-slate-500 line-clamp-3 mb-6 leading-relaxed">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>
                                <span class="text-[10px] font-black uppercase tracking-widest flex items-center justify-center lg:justify-start gap-2">Read More <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg></span>
                            @endif
                        </a>
                    </article>
                @empty
                    <p class="text-slate-400">Belum ada artikel tersedia.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                {{ $regularArticles->links() }}
            </div>
        </div>
    </section>

    <!-- 4. FOOTER BOX -->
    <footer class="py-16 md:py-24">
        <div class="container mx-auto px-6">
            <div class="border-[6px] md:border-[10px] border-slate-900 p-10 md:p-16 text-center journal-reveal">
                <div class="flex flex-col items-center gap-6 max-w-2xl mx-auto mb-10 md:mb-12">
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-[#da291c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-lg md:text-xl text-slate-500 italic font-medium leading-relaxed">Informasi dalam blog ini bersifat edukatif dan terus diperbarui sesuai dengan kebijakan terbaru ketenagakerjaan Jepang.</p>
                </div>
                <h3 class="text-3xl md:text-4xl font-black text-slate-900 mb-8 uppercase tracking-tighter leading-none italic">Tetap Terkoneksi Dengan Informasi</h3>
                <div class="w-24 h-px bg-[#da291c] mx-auto mb-8"></div>
                <span class="text-[8px] md:text-[10px] font-black tracking-[0.4em] md:tracking-[0.8em] text-slate-300 uppercase">Ayaka Journal Series</span>
            </div>
        </div>
    </footer>
</div>

<style>
    .journal-reveal {
        opacity: 0;
        transform: translateY(30px);
        animation: reveal 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes reveal {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
