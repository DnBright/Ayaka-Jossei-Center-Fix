@extends('layouts.admin')

@section('page-title', 'Pengaturan Umum Website')

@section('content')
<div class="settings-container max-w-4xl">
    <div class="mb-10">
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Pengaturan Umum</h1>
        <p class="text-slate-500 font-medium mt-1">Konfigurasi dasar website, identitas lembaga, dan SEO.</p>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-bold text-sm border border-emerald-100">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')
        
        <!-- Identitas Website -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#da291c] shadow-sm">
                    <i data-lucide="globe" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-black text-slate-900">Identitas Website</h3>
            </div>
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Judul Website (SEO)</label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'Ayaka Josei Center' }}" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tagline / Slogan</label>
                        <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi Meta</label>
                    <textarea name="site_description" rows="3" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold focus:outline-none focus:border-[#da291c] transition-all">{{ $settings['site_description'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Social Media -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#da291c] shadow-sm">
                    <i data-lucide="share-2" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-black text-slate-900">Media Sosial</h3>
            </div>
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Instagram URL</label>
                    <div class="relative">
                        <i data-lucide="instagram" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-4 h-4"></i>
                        <input type="text" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}" class="w-full pl-12 pr-5 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Facebook URL</label>
                    <div class="relative">
                        <i data-lucide="facebook" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-4 h-4"></i>
                        <input type="text" name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}" class="w-full pl-12 pr-5 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-end gap-4">
            <button type="button" onclick="history.back()" class="px-8 py-4 bg-slate-100 text-slate-400 font-black text-sm uppercase tracking-widest rounded-2xl hover:bg-slate-200 transition-all">Batal</button>
            <button type="submit" class="px-10 py-4 bg-[#da291c] text-white font-black text-sm uppercase tracking-widest rounded-2xl shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
