@extends('layouts.admin')

@section('page-title', 'Edit Program & Kurikulum')

@section('content')
<div class="editor-container">
    <!-- Header -->
    <div class="mb-10">
        <a href="/admin/halaman" class="inline-flex items-center gap-2 text-slate-400 font-black text-[10px] uppercase tracking-widest hover:text-[#da291c] transition-colors mb-4">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali ke Manajemen Halaman
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Manajemen Program</h1>
        <p class="text-slate-500 font-medium mt-1">Kelola daftar program pelatihan dan kurikulum yang ditawarkan.</p>
    </div>

    <!-- Program List -->
    <div class="space-y-6">
        @php
            $programs = [
                ['title' => 'Tokutei Ginou (Kaigo)', 'desc' => 'Program pengasuh lansia dengan kontrak kerja 5 tahun.', 'icon' => 'heart'],
                ['title' => 'Tokutei Ginou (Food Service)', 'desc' => 'Program industri pengolahan makanan dan restoran.', 'icon' => 'utensils'],
                ['title' => 'Magang (Ginou Jisshu)', 'desc' => 'Program pemagangan industri manufaktur dan pertanian.', 'icon' => 'cog'],
            ];
        @endphp

        @foreach($programs as $prog)
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden group">
                <div class="px-8 py-6 flex justify-between items-center bg-slate-50/50 border-b border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#da291c] shadow-sm">
                            <i data-lucide="{{ $prog['icon'] }}" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-lg font-black text-slate-900">{{ $prog['title'] }}</h3>
                    </div>
                    <div class="flex gap-2">
                        <button class="w-9 h-9 bg-white border border-slate-100 text-slate-400 rounded-lg flex items-center justify-center hover:bg-[#da291c] hover:text-white transition-all"><i data-lucide="edit-3" class="w-4 h-4"></i></button>
                        <button class="w-9 h-9 bg-white border border-slate-100 text-slate-400 rounded-lg flex items-center justify-center hover:bg-red-600 hover:text-white transition-all"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                    </div>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Headline Program</label>
                        <input type="text" value="{{ $prog['title'] }}" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi Singkat</label>
                        <input type="text" value="{{ $prog['desc'] }}" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                </div>
            </div>
        @endforeach

        <button class="w-full py-8 border-2 border-dashed border-slate-200 rounded-[32px] text-slate-400 font-black text-xs uppercase tracking-[0.2em] hover:bg-slate-50 hover:border-[#da291c] hover:text-[#da291c] transition-all flex flex-col items-center gap-3">
            <i data-lucide="plus-circle" class="w-8 h-8"></i>
            Tambah Program Baru
        </button>
    </div>

    <!-- Actions -->
    <div class="flex justify-end gap-4 mt-12">
        <button type="submit" class="px-12 py-5 bg-[#da291c] text-white font-black text-sm uppercase tracking-widest rounded-2xl shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
            <i data-lucide="save" class="w-5 h-5"></i>
            Update Semua Program
        </button>
    </div>
</div>
@endsection
