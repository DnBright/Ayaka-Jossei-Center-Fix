@extends('layouts.admin')

@section('page-title', 'Perpustakaan E-Book Materi')

@section('content')
<div class="ebook-manager-container">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Perpustakaan E-Book Materi</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola koleksi materi edukasi digital untuk member Ayaka Josei Center.</p>
        </div>
        <button class="bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="plus" class="w-5 h-5"></i>
            Upload E-Book Baru
        </button>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 flex items-center gap-5 shadow-sm">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i data-lucide="book"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Koleksi</p>
                <p class="text-2xl font-black text-slate-900">42 E-Book</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 flex items-center gap-5 shadow-sm">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center"><i data-lucide="download"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Download</p>
                <p class="text-2xl font-black text-slate-900">1,240 Kali</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 flex items-center gap-5 shadow-sm">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center"><i data-lucide="eye"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Views</p>
                <p class="text-2xl font-black text-slate-900">3,450 Views</p>
            </div>
        </div>
    </div>

    <!-- E-Book Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @for($i = 1; $i <= 6; $i++)
            <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all group">
                <div class="flex gap-6 items-start mb-6">
                    <div class="w-24 h-32 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 group-hover:bg-red-50 group-hover:text-[#da291c] transition-all relative shrink-0 border border-slate-100 shadow-inner">
                        <i data-lucide="book" class="w-10 h-10"></i>
                        <span class="absolute -bottom-2 -right-2 bg-white border border-slate-100 px-3 py-1 rounded-full text-[9px] font-black text-blue-600 shadow-sm">
                            <i data-lucide="eye" class="w-2.5 h-2.5 inline mr-1"></i> 142
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center mb-2">
                            <span class="bg-red-50 text-[#da291c] px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest">Kurikulum</span>
                            <span class="bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest">Published</span>
                        </div>
                        <h4 class="text-lg font-black text-slate-900 line-clamp-2 mb-2 group-hover:text-[#da291c] transition-colors">Modul Dasar Bahasa Jepang Batch {{ $i }}</h4>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed line-clamp-2">Materi dasar pengenalan Hiragana, Katakana, dan tata bahasa sederhana untuk persiapan N5.</p>
                    </div>
                </div>
                <div class="pt-6 border-t border-slate-50 flex justify-between items-center">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Version 1.{{ $i }}</span>
                    <div class="flex gap-2">
                        <button class="text-xs font-black text-blue-600 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">Edit</button>
                        <button class="text-xs font-black text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors">Delete</button>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
