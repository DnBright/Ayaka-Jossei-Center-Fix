@extends('layouts.admin')

@section('page-title', 'Media Library Ayaka')

@section('content')
<div class="media-manager-container">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Media Library Ayaka</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola koleksi aset visual, dokumentasi, dan media konten edukasi.</p>
        </div>
        <button class="bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="upload" class="w-5 h-5"></i>
            Upload Media Baru
        </button>
    </div>

    <!-- Toolbar -->
    <div class="bg-white rounded-[24px] p-4 border border-slate-100 shadow-sm mb-10 flex flex-col lg:flex-row justify-between items-center gap-6">
        <div class="relative flex-1 w-full lg:max-w-md">
            <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5"></i>
            <input type="text" placeholder="Telusuri aset media..." class="w-full pl-14 pr-6 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-sm focus:outline-none focus:border-[#da291c] transition-all">
        </div>
        <div class="flex items-center gap-4 w-full lg:w-auto">
            <button class="flex items-center gap-3 px-5 py-3.5 bg-slate-50 text-slate-600 font-black text-xs uppercase tracking-widest rounded-xl hover:bg-slate-100 transition-colors">
                <i data-lucide="filter" class="w-4 h-4"></i>
                Filter
            </button>
            <div class="flex bg-slate-100 p-1 rounded-xl">
                <button class="p-2.5 bg-white text-[#da291c] rounded-lg shadow-sm"><i data-lucide="grid" class="w-4 h-4"></i></button>
                <button class="p-2.5 text-slate-400 rounded-lg"><i data-lucide="list" class="w-4 h-4"></i></button>
            </div>
        </div>
    </div>

    <!-- Media Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
        @php
            $media = [
                ['name' => 'Tokyo Street.jpg', 'size' => '2.4 MB', 'date' => '2024-01-15', 'url' => 'https://images.unsplash.com/photo-1528659526084-59de817f5413?auto=format&fit=crop&q=80'],
                ['name' => 'Student Batch 1.jpg', 'size' => '1.8 MB', 'date' => '2024-02-01', 'url' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&q=80'],
                ['name' => 'Classroom.jpg', 'size' => '3.1 MB', 'date' => '2024-02-10', 'url' => 'https://images.unsplash.com/photo-1624253321171-1be53e12f5f4?auto=format&fit=crop&q=80'],
                ['name' => 'Japan Flag.jpg', 'size' => '1.2 MB', 'date' => '2024-03-05', 'url' => 'https://images.unsplash.com/photo-1542051841857-5f90071e7989?auto=format&fit=crop&q=80'],
                ['name' => 'Mt Fuji.jpg', 'size' => '4.5 MB', 'date' => '2024-03-12', 'url' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&q=80'],
                ['name' => 'Graduation.jpg', 'size' => '2.9 MB', 'date' => '2024-03-20', 'url' => 'https://images.unsplash.com/photo-1523240715181-2f0f9f20dd98?auto=format&fit=crop&q=80'],
            ];
        @endphp

        @foreach($media as $item)
            <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all group relative">
                <div class="aspect-square bg-slate-50 relative overflow-hidden">
                    <img src="{{ $item['url'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                        <button class="w-10 h-10 bg-white text-slate-900 rounded-xl flex items-center justify-center hover:bg-[#da291c] hover:text-white transition-all"><i data-lucide="eye" class="w-5 h-5"></i></button>
                        <button class="w-10 h-10 bg-red-600 text-white rounded-xl flex items-center justify-center hover:bg-red-700 transition-all shadow-lg shadow-red-900/20"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
                    </div>
                </div>
                <div class="p-4">
                    <h5 class="text-[11px] font-black text-slate-900 truncate mb-1" title="{{ $item['name'] }}">{{ $item['name'] }}</h5>
                    <div class="flex items-center justify-between text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                        <span>{{ $item['size'] }}</span>
                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                        <span>{{ date('d/m/y', strtotime($item['date'])) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
