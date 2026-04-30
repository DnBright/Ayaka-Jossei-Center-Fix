@extends('layouts.app')

@section('title', $article->title . ' - Ayaka Josei Center')

@section('content')
<div class="article-detail-wrapper font-['Outfit'] bg-white">
    <!-- 1. ARTICLE HEADER -->
    <header class="py-16 md:py-24 border-b border-slate-100">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="text-center mb-12">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-[#da291c] font-black uppercase tracking-widest text-[10px] mb-8 hover:-translate-x-2 transition-transform">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"></path></svg>
                    Kembali Ke Blog
                </a>
                <div class="flex justify-center gap-4 mb-6 text-[10px] font-black uppercase tracking-widest text-slate-400">
                    <span class="bg-slate-100 px-3 py-1 rounded text-slate-600">{{ $article->category->name ?? 'Uncategorized' }}</span>
                    <span class="flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $article->created_at->format('M d, Y') }}</span>
                    <span class="text-[#da291c]">{{ number_format($article->views_count) }} Views</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tighter leading-[1.1] uppercase italic mb-8">
                    {{ $article->title }}
                </h1>
                <div class="flex items-center justify-center gap-4">
                    <div class="w-10 h-10 bg-[#da291c] rounded-full flex items-center justify-center text-white font-bold text-xs uppercase">
                        {{ substr($article->author->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="text-left">
                        <div class="text-xs font-black text-slate-900 uppercase tracking-widest">{{ $article->author->name ?? 'Administrator' }}</div>
                        <div class="text-[10px] font-medium text-slate-400 uppercase tracking-widest">Penulis Resmi AJC</div>
                    </div>
                </div>
            </div>

            <div class="rounded-[40px] overflow-hidden aspect-[21/9] bg-slate-100 shadow-2xl">
                @php
                    $featuredImage = str_starts_with($article->featured_image ?? '', 'http')
                        ? $article->featured_image
                        : ($article->featured_image
                            ? asset($article->featured_image)
                            : asset('images/hero-bg.png'));
                @endphp
                <img src="{{ $featuredImage }}" class="w-full h-full object-cover" alt="{{ $article->title }}">
            </div>
        </div>
    </header>

    <!-- 2. ARTICLE CONTENT -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-6 max-w-3xl">
            <div class="article-content prose prose-slate prose-lg max-w-none">
                {!! $article->content !!}
            </div>

            <!-- Share Section -->
            <div class="mt-20 pt-12 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-sm font-black text-slate-900 uppercase tracking-widest">Bagikan Artikel Ini</div>
                <div class="flex gap-4">
                    @php $shareUrl = urlencode(request()->fullUrl()); @endphp
                    <a href="https://wa.me/?text={{ $shareUrl }}" target="_blank" class="w-12 h-12 border border-slate-200 rounded-full flex items-center justify-center text-slate-900 hover:bg-[#25D366] hover:text-white hover:border-[#25D366] transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.888 11.888-11.888 3.176 0 6.161 1.237 8.404 3.48s3.481 5.229 3.481 8.406c0 6.555-5.332 11.887-11.886 11.887-2.003 0-3.968-.511-5.717-1.483l-6.269 1.644zm11.831-2.094c1.89 0 3.741-.508 5.35-1.467l.384-.227 3.978 1.042-1.061-3.873.249-.396c1.053-1.678 1.607-3.628 1.607-5.631 0-5.46-4.441-9.901-9.901-9.901-2.646 0-5.133 1.03-7.003 2.9s-2.899 4.357-2.899 7.001c0 5.461 4.441 9.901 9.901 9.901h-.005zm5.432-7.411c-.298-.149-1.762-.87-2.035-.97s-.472-.149-.671.149-.77.97-.944 1.168-.348.223-.646.074c-.298-.149-1.258-.464-2.396-1.48-1.48-1.32-2.478-2.951-2.776-3.45-.298-.499-.032-.769.216-1.016.223-.223.497-.582.745-.873s.331-.497.497-.828c.166-.33.083-.618-.041-.869s-.671-1.618-.919-2.215c-.242-.581-.487-.502-.671-.512l-.571-.01c-.198 0-.522.074-.795.372s-1.043 1.018-1.043 2.482 1.068 2.88 1.217 3.079c.149.198 2.099 3.205 5.084 4.495.71.307 1.264.49 1.696.627.712.226 1.36.194 1.872.118.571-.085 1.762-.72 2.01-.1.415.248.694.248 1.168 0 .473-.248.149-.472.074-.298-.149z"></path></svg>
                    </a>
                    <a href="https://facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="w-12 h-12 border border-slate-200 rounded-full flex items-center justify-center text-slate-900 hover:bg-[#1877F2] hover:text-white hover:border-[#1877F2] transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.312h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.324v-21.35c0-.732-.593-1.325-1.325-1.325z"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. RELATED ARTICLES -->
    @if($relatedArticles->count() > 0)
    <section class="py-16 md:py-24 bg-slate-50">
        <div class="container mx-auto px-6">
            <h3 class="text-2xl font-black text-slate-900 mb-12 uppercase italic tracking-tighter">Artikel Terkait</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedArticles as $rel)
                    <article class="group">
                        <a href="{{ route('blog.show', $rel->slug) }}" class="block bg-white p-6 rounded-3xl border border-slate-100 hover:shadow-2xl transition-all">
                            <div class="aspect-video rounded-2xl overflow-hidden mb-6">
                                <img src="{{ str_starts_with($rel->featured_image ?? '', 'http') ? $rel->featured_image : asset($rel->featured_image ?? 'images/hero-bg.png') }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" alt="Post">
                            </div>
                            <div class="text-[10px] font-black uppercase tracking-widest text-[#da291c] mb-3">{{ $rel->category->name ?? 'Kategori' }}</div>
                            <h4 class="text-xl font-black text-slate-900 leading-tight mb-4 group-hover:text-[#da291c] transition-colors italic uppercase">{{ $rel->title }}</h4>
                            <span class="text-[10px] font-black uppercase tracking-widest flex items-center gap-2">Baca Sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg></span>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
