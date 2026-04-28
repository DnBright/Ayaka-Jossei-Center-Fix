@extends('layouts.admin')

@section('page-title', 'Edit Tentang Ayaka')

@section('content')
<div class="editor-container max-w-4xl">
    <!-- Header -->
    <div class="mb-10">
        <a href="/admin/halaman" class="inline-flex items-center gap-2 text-slate-400 font-black text-[10px] uppercase tracking-widest hover:text-[#da291c] transition-colors mb-4">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali ke Manajemen Halaman
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Edit Halaman Profil</h1>
        <p class="text-slate-500 font-medium mt-1">Kelola informasi visi, misi, dan sejarah lembaga.</p>
    </div>

    <form class="space-y-8">
        <!-- Visi & Misi -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#da291c] shadow-sm">
                    <i data-lucide="target" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-black text-slate-900">Visi & Misi</h3>
            </div>
            <div class="p-8 space-y-8">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Visi Lembaga</label>
                    <textarea rows="3" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-base font-bold focus:outline-none focus:border-[#da291c] transition-all">Menjadi pusat pelatihan bahasa dan budaya Jepang terkemuka di Indonesia yang mencetak tenaga kerja wanita profesional dan berintegritas.</textarea>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Misi Lembaga (Gunakan baris baru untuk setiap poin)</label>
                    <textarea rows="6" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-base font-bold focus:outline-none focus:border-[#da291c] transition-all">Memberikan pelatihan bahasa Jepang intensif berstandar industri.
Membangun karakter dan etos kerja profesional ala Jepang.
Menjalin kemitraan strategis dengan perusahaan-perusahaan di Jepang.
Mendukung kemandirian ekonomi wanita Indonesia melalui karir global.</textarea>
                </div>
            </div>
        </div>

        <!-- Sejarah / Deskripsi -->
        <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#da291c] shadow-sm">
                    <i data-lucide="history" class="w-5 h-5"></i>
                </div>
                <h3 class="text-lg font-black text-slate-900">Sejarah & Filosofi</h3>
            </div>
            <div class="p-8">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Teks Sejarah Singkat</label>
                    <textarea rows="8" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-base font-bold focus:outline-none focus:border-[#da291c] transition-all">Ayaka Josei Center didirikan pada tahun 2018 dengan fokus utama memberikan kesempatan bagi wanita Indonesia untuk berkarir di Jepang secara legal dan profesional. Kami percaya bahwa dengan pelatihan yang tepat, potensi wanita Indonesia dapat bersaing di pasar kerja internasional, khususnya di Jepang yang sangat menghargai ketelitian dan dedikasi.</textarea>
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
