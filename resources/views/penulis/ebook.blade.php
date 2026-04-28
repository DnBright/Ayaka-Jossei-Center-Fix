@extends('layouts.penulis')

@section('page-title', 'E-Book Materi')

@section('content')
<div class="ebook-container">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">E-Book & Materi</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola materi edukasi digital yang telah Anda susun.</p>
        </div>
        <button class="bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="upload" class="w-5 h-5"></i>
            Upload Materi Baru
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @for($i = 1; $i <= 3; $i++)
            <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all group">
                <div class="flex gap-6 items-start mb-6">
                    <div class="w-24 h-32 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 group-hover:bg-red-50 group-hover:text-[#da291c] transition-all relative shrink-0 border border-slate-100 shadow-inner">
                        <i data-lucide="book" class="w-10 h-10"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center mb-2">
                            <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest">Edukasi</span>
                            <span class="bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest">Live</span>
                        </div>
                        <h4 class="text-lg font-black text-slate-900 line-clamp-2 mb-2 group-hover:text-[#da291c] transition-colors">Modul Tata Bahasa N{{ 6-$i }}</h4>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed line-clamp-2">Materi khusus untuk persiapan ujian kemampuan bahasa Jepang level dasar.</p>
                    </div>
                </div>
                <div class="pt-6 border-t border-slate-50 flex justify-between items-center">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">v1.2</span>
                    <div class="flex gap-2">
                        <button class="text-xs font-black text-blue-600 hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">Edit</button>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
