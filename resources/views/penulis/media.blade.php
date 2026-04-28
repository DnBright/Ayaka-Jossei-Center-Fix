@extends('layouts.penulis')

@section('page-title', 'Media Assets')

@section('content')
<div class="media-container">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Media Assets</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola gambar dan media untuk artikel Anda.</p>
        </div>
        <button class="bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="upload" class="w-5 h-5"></i>
            Upload Media
        </button>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @for($i = 1; $i <= 5; $i++)
            <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all group relative">
                <div class="aspect-square bg-slate-50 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1528659526084-59de817f5413?auto=format&fit=crop&q=80&w={{ 200 + ($i*10) }}" alt="Asset" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                        <button class="w-10 h-10 bg-white text-slate-900 rounded-xl flex items-center justify-center hover:bg-[#da291c] hover:text-white transition-all"><i data-lucide="eye" class="w-5 h-5"></i></button>
                    </div>
                </div>
                <div class="p-4">
                    <h5 class="text-[11px] font-black text-slate-900 truncate mb-1">asset-{{ $i }}.jpg</h5>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">1.2 MB</p>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
