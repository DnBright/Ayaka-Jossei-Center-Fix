@extends('layouts.admin')

@section('page-title', 'Edit Konten: ' . $page->title)

@section('content')
<div class="edit-page-container">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('admin.halaman.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Manajemen Halaman</span>
            </div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Edit Konten: {{ $page->title }}</h1>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.halaman.index') }}" class="px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-slate-200 transition-all">Batal</a>
            <button form="edit-page-form" type="submit" class="bg-gradient-to-r from-[#da291c] to-[#b91c1c] text-white px-8 py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Perubahan
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-bold text-sm border border-emerald-100">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
        <form id="edit-page-form" action="{{ route('admin.halaman.update', $page->slug) }}" method="POST" class="p-10">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-10">
                @php
                    $pageContent = is_array($page->content) ? $page->content : json_decode($page->content, true);
                    $pageContent = $pageContent ?? [];
                @endphp
                @foreach($pageContent as $key => $value)
                    <div class="group">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 group-focus-within:text-[#da291c] transition-colors">
                            {{ str_replace('_', ' ', strtoupper($key)) }}
                        </label>
                        
                        @if(strlen($value) > 100)
                            <textarea name="content[{{ $key }}]" rows="5" class="w-full px-8 py-6 bg-slate-50 border border-slate-100 rounded-[24px] text-slate-700 font-medium focus:outline-none focus:border-[#da291c] focus:bg-white transition-all shadow-inner">{{ $value }}</textarea>
                        @else
                            <input type="text" name="content[{{ $key }}]" value="{{ $value }}" class="w-full px-8 py-6 bg-slate-50 border border-slate-100 rounded-[24px] text-slate-700 font-medium focus:outline-none focus:border-[#da291c] focus:bg-white transition-all shadow-inner">
                        @endif
                        
                        <p class="text-[10px] text-slate-400 mt-2 font-medium italic">Kunci ID: {{ $key }}</p>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-12 pt-10 border-t border-slate-50">
                <div class="flex items-center gap-4 p-6 bg-amber-50 rounded-2xl border border-amber-100">
                    <i data-lucide="alert-triangle" class="w-6 h-6 text-amber-600 shrink-0"></i>
                    <p class="text-xs font-bold text-amber-700 leading-relaxed">
                        Perhatian: Perubahan ini akan langsung berdampak pada tampilan publik di halaman depan website. Pastikan konten yang dimasukkan sudah benar dan sesuai dengan format yang ada.
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
