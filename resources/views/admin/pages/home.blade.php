@extends('layouts.admin')

@section('page-title', 'Edit Halaman Home')

@section('content')
<div class="editor-container max-w-4xl">
    <!-- Header -->
    <div class="mb-10">
        <a href="/admin/halaman" class="inline-flex items-center gap-2 text-slate-400 font-black text-[10px] uppercase tracking-widest hover:text-[#da291c] transition-colors mb-4">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali ke Manajemen Halaman
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Edit Halaman Home</h1>
        <p class="text-slate-500 font-medium mt-1">Konfigurasi teks hero, tagline, dan ajakan bertindak (CTA).</p>
    </div>

    <form class="space-y-8">
        <!-- Hero Section -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#da291c] shadow-sm">
                    <i data-lucide="layout-template" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-black text-slate-900">Hero Section</h3>
            </div>
            <div class="p-8 space-y-8">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Headline Utama</label>
                    <input type="text" placeholder="Contoh: Wujudkan Mimpi Bekerja di Jepang" value="Wujudkan Mimpi Bekerja di Jepang" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-base font-bold focus:outline-none focus:border-[#da291c] transition-all">
                    <p class="text-[10px] text-slate-400 font-medium italic">Judul besar yang muncul pertama kali di bagian atas halaman.</p>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sub-Headline</label>
                    <textarea rows="4" placeholder="Deskripsi singkat di bawah judul utama..." class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-base font-bold focus:outline-none focus:border-[#da291c] transition-all">Pusat pelatihan bahasa dan budaya Jepang untuk wanita yang ingin berkarir profesional di Jepang dengan standar industri global.</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Teks Tombol CTA</label>
                        <input type="text" value="Konsultasi Gratis" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-base font-bold focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Link Tombol CTA</label>
                        <input type="text" value="https://wa.me/62812345678" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-base font-bold focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Image -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#da291c] shadow-sm">
                    <i data-lucide="image" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-black text-slate-900">Background Hero</h3>
            </div>
            <div class="p-8">
                <div class="w-full h-64 bg-slate-100 rounded-3xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 group hover:border-[#da291c] hover:bg-red-50 transition-all cursor-pointer">
                    <i data-lucide="upload-cloud" class="w-12 h-12 mb-4 group-hover:scale-110 transition-transform"></i>
                    <p class="font-black text-xs uppercase tracking-[0.2em]">Klik untuk ganti gambar</p>
                    <p class="text-[10px] mt-2 font-medium">Rekomendasi ukuran: 1920x1080px (Maks 2MB)</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-4 pt-4">
            <button type="button" class="px-8 py-4 bg-white border border-slate-100 text-slate-400 font-black text-sm uppercase tracking-widest rounded-2xl hover:bg-slate-50 transition-all">Reset</button>
            <button type="submit" class="px-10 py-4 bg-[#da291c] text-white font-black text-sm uppercase tracking-widest rounded-2xl shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
