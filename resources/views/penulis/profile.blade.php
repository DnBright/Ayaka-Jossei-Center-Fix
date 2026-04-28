@extends('layouts.penulis')

@section('page-title', 'Profil Saya')

@section('content')
<div class="profile-container max-w-5xl">
    <div class="mb-10">
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Profil Saya</h1>
        <p class="text-slate-500 font-medium mt-1">Kelola informasi personal dan pengaturan akun Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white p-8 rounded-[32px] border border-slate-100 shadow-sm text-center flex flex-col items-center">
                <div class="w-28 h-28 bg-slate-50 rounded-full flex items-center justify-center text-[#da291c] border-4 border-white shadow-xl mb-6 relative group overflow-hidden">
                    <i data-lucide="user" class="w-12 h-12"></i>
                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                        <i data-lucide="camera" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                <h3 class="text-xl font-black text-slate-900">Penulis User</h3>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-2 bg-slate-50 px-4 py-1.5 rounded-full">Content Writer</p>
                
                <div class="mt-10 w-full pt-10 border-t border-slate-50 space-y-4">
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-bold uppercase tracking-widest">Total Artikel</span>
                        <span class="text-slate-900 font-black">24</span>
                    </div>
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-slate-400 font-bold uppercase tracking-widest">Total Views</span>
                        <span class="text-slate-900 font-black">12.5k</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Area -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Account Details -->
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#da291c] shadow-sm">
                        <i data-lucide="shield" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Detail Akun</h3>
                </div>
                <div class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap</label>
                            <input type="text" value="Penulis Ayaka Josei" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold focus:outline-none focus:border-[#da291c] transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</label>
                            <input type="email" value="penulis@ayakajosei.com" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold focus:outline-none focus:border-[#da291c] transition-all">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security -->
            <div class="bg-white rounded-[32px] border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#da291c] shadow-sm">
                        <i data-lucide="key" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900">Keamanan</h3>
                </div>
                <div class="p-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Password Baru</label>
                        <input type="password" placeholder="••••••••" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold focus:outline-none focus:border-[#da291c] transition-all">
                    </div>
                </div>
            </div>

            <!-- Save -->
            <div class="flex justify-end">
                <button type="submit" class="px-10 py-4 bg-[#da291c] text-white font-black text-sm uppercase tracking-widest rounded-2xl shadow-xl shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center gap-3">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Update Profil
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
