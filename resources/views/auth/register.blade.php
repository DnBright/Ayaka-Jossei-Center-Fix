@extends('layouts.app')

@section('title', 'Daftar Akun - Ayaka Josei Center')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 py-24 px-6">
    <div class="max-w-md w-full bg-white rounded-[40px] shadow-2xl border border-slate-100 overflow-hidden reveal-up">
        <div class="p-10 md:p-12">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-[#da291c]/5 text-[#da291c] rounded-2xl mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter uppercase italic leading-none mb-4">Join AJC</h1>
                <p class="text-slate-500 text-sm font-medium">Daftarkan akun untuk akses eksklusif materi E-Book dan Jurnal Pelatihan.</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-900 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#da291c]/20 focus:border-[#da291c] transition-all" placeholder="Masukkan nama sesuai KTP">
                    @error('name') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Alamat Email</label>
                    <input type="email" name="email" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-900 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#da291c]/20 focus:border-[#da291c] transition-all" placeholder="contoh@email.com">
                    @error('email') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Password</label>
                    <input type="password" name="password" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-900 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#da291c]/20 focus:border-[#da291c] transition-all" placeholder="Minimal 8 karakter">
                    @error('password') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-900 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#da291c]/20 focus:border-[#da291c] transition-all" placeholder="Ulangi password">
                </div>

                <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-[#da291c] transition-all shadow-xl shadow-slate-200">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-slate-100 text-center">
                <p class="text-slate-500 text-xs font-bold">Sudah punya akun? <a href="{{ route('login') }}" class="text-[#da291c] hover:underline ml-1">Masuk di sini</a></p>
            </div>
        </div>
    </div>
</div>

<style>
    .reveal-up {
        opacity: 0;
        transform: translateY(20px);
        animation: revealUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes revealUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
