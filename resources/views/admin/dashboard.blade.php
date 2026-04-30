@extends('layouts.admin')

@section('page-title', 'Dashboard Overview')

@section('content')
<div class="dashboard-container">
    <!-- 1. Welcome Area -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 bg-gradient-to-br from-[#da291c] to-[#991b1b] rounded-2xl flex items-center justify-center text-white text-2xl font-black shadow-xl shadow-red-900/20">
                A
            </div>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Selamat Datang, Admin</h1>
                <p class="text-slate-500 font-medium mt-1">Berikut adalah ringkasan performa konten Anda hari ini.</p>
            </div>
        </div>
        <form method="GET" class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl border border-slate-200 shadow-sm text-slate-500 font-bold text-sm transition-all hover:border-[#da291c]">
            <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i>
            <input type="date" name="date_filter" value="{{ request('date_filter') }}" class="border-none bg-transparent p-0 text-sm focus:ring-0 text-slate-600 outline-none cursor-pointer" onchange="this.form.submit()">
            @if(request('date_filter'))
                <a href="{{ url()->current() }}" class="ml-2 w-5 h-5 bg-red-50 text-[#da291c] rounded-full flex items-center justify-center hover:bg-[#da291c] hover:text-white transition-colors" title="Hapus Filter">
                    <i data-lucide="x" class="w-3 h-3"></i>
                </a>
            @endif
        </form>
    </div>

    <!-- 2. Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group relative overflow-hidden">
            <div class="flex flex-col gap-4 relative z-10">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="message-square"></i>
                </div>
                <div>
                    <span class="flex items-end gap-2 mb-2">
                        <span class="block text-3xl font-black text-slate-900 leading-none">{{ $stats['total_messages'] }}</span>
                        @if(request('date_filter'))<span class="text-xs font-bold text-slate-400 mb-0.5">/ {{ $totalStats['total_messages'] }} Total</span>@endif
                    </span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pesan</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group relative overflow-hidden">
            <div class="flex flex-col gap-4 relative z-10">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="users"></i>
                </div>
                <div>
                    <span class="flex items-end gap-2 mb-2">
                        <span class="block text-3xl font-black text-slate-900 leading-none">{{ $stats['total_users'] }}</span>
                        @if(request('date_filter'))<span class="text-xs font-bold text-slate-400 mb-0.5">/ {{ $totalStats['total_users'] }} Total</span>@endif
                    </span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Member</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group relative overflow-hidden">
            <div class="flex flex-col gap-4 relative z-10">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="file-text"></i>
                </div>
                <div>
                    <span class="flex items-end gap-2 mb-2">
                        <span class="block text-3xl font-black text-slate-900 leading-none">{{ number_format($stats['article_views']) }}</span>
                        @if(request('date_filter'))<span class="text-xs font-bold text-slate-400 mb-0.5">/ {{ number_format($totalStats['article_views']) }} Total</span>@endif
                    </span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">View Artikel</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group relative overflow-hidden">
            <div class="flex flex-col gap-4 relative z-10">
                <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="book-open"></i>
                </div>
                <div>
                    <span class="flex items-end gap-2 mb-2">
                        <span class="block text-3xl font-black text-slate-900 leading-none">{{ number_format($stats['ebook_downloads']) }}</span>
                        @if(request('date_filter'))<span class="text-xs font-bold text-slate-400 mb-0.5">/ {{ number_format($totalStats['ebook_downloads']) }} Total</span>@endif
                    </span>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Download E-Book</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Detailed Analytics -->
    <div class="grid lg:grid-cols-2 gap-8">
        <!-- Top Articles -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-8 py-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-black text-slate-900 flex items-center gap-3">
                    <i data-lucide="file-text" class="w-5 h-5 text-[#da291c]"></i>
                    Artikel Terpopuler
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/30">
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Judul</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Views</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($topArticles as $article)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <div class="font-bold text-slate-700 line-clamp-1">{{ $article->title }}</div>
                                <span class="text-[9px] font-black text-[#da291c] uppercase tracking-widest">{{ $article->category->name ?? 'Uncategorized' }}</span>
                            </td>
                            <td class="px-8 py-5 font-black text-blue-600">{{ number_format($article->views_count) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-8 py-10 text-center text-slate-400 font-bold text-xs uppercase tracking-widest">Belum ada artikel</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top E-Books -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
            <div class="px-8 py-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-black text-slate-900 flex items-center gap-3">
                    <i data-lucide="book-open" class="w-5 h-5 text-violet-500"></i>
                    E-Book Terpopuler
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/30">
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Judul E-Book</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Downloads</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($topEbooks as $ebook)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5 font-bold text-slate-700">{{ $ebook->title }}</td>
                            <td class="px-8 py-5 font-black text-violet-600">{{ number_format($ebook->download_count) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-8 py-10 text-center text-slate-400 font-bold text-xs uppercase tracking-widest">Belum ada e-book</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>

<style>
    /* Add any custom dashboard styles here if Tailwind isn't enough */
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
