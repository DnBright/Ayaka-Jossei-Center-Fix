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
        <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl border border-slate-200 shadow-sm text-slate-500 font-bold text-sm">
            <i data-lucide="calendar" class="w-4 h-4"></i>
            {{ date('d F Y') }}
        </div>
    </div>

    <!-- 2. Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        @php
            $stats = [
                ['label' => 'Total Pesan', 'value' => '128', 'icon' => 'message-square', 'color' => 'blue'],
                ['label' => 'Pengunjung', 'value' => '2.4k', 'icon' => 'users', 'color' => 'amber'],
                ['label' => 'View Artikel', 'value' => '15.8k', 'icon' => 'file-text', 'color' => 'emerald'],
                ['label' => 'View E-Book', 'value' => '3.2k', 'icon' => 'book-open', 'color' => 'violet'],
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group relative overflow-hidden">
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-{{ $stat['color'] }}-50 text-{{ $stat['color'] }}-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="{{ $stat['icon'] }}"></i>
                    </div>
                    <div>
                        <span class="block text-3xl font-black text-slate-900 leading-none mb-2">{{ $stat['value'] }}</span>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $stat['label'] }}</span>
                    </div>
                </div>
                <div class="absolute top-6 right-6 flex items-center gap-1 text-emerald-500 text-[10px] font-black">
                    <i data-lucide="trending-up" class="w-3 h-3"></i>
                    ACTIVE
                </div>
            </div>
        @endforeach
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
                <span class="bg-white border border-slate-200 text-slate-500 px-3 py-1 rounded-full text-[10px] font-black">TOP 10</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/30">
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Judul</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Views</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @for($i = 1; $i <= 5; $i++)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <div class="font-bold text-slate-700 line-clamp-1">Strategi Lulus Interview Batch {{ $i }}</div>
                                <span class="text-[9px] font-black text-[#da291c] uppercase tracking-widest">Karir</span>
                            </td>
                            <td class="px-8 py-5 font-black text-blue-600">{{ 1200 - ($i * 150) }}</td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                    <span class="text-[10px] font-bold text-slate-500">Terbit</span>
                                </div>
                            </td>
                        </tr>
                        @endfor
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
                <span class="bg-white border border-slate-200 text-slate-500 px-3 py-1 rounded-full text-[10px] font-black">TOP 10</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/30">
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Judul E-Book</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Views</th>
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">Interest</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @for($i = 1; $i <= 5; $i++)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5 font-bold text-slate-700">Materi Bahasa Jepang Level N{{ 6 - $i }}</td>
                            <td class="px-8 py-5 font-black text-violet-600">{{ 800 - ($i * 100) }}</td>
                            <td class="px-8 py-5">
                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-violet-500" style="width: {{ 100 - ($i * 15) }}%"></div>
                                </div>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
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
