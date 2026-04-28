@extends('layouts.app')

@section('title', 'Masuk Akun - Ayaka Josei Center')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 py-24 px-6">
    <div class="max-w-md w-full bg-white rounded-[40px] shadow-2xl border border-slate-100 overflow-hidden reveal-up">
        <div class="p-10 md:p-12">
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-[#da291c]/5 text-[#da291c] rounded-2xl mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                </div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter uppercase italic leading-none mb-4">Masuk Akun</h1>
                <p class="text-slate-500 text-sm font-medium">Masuk untuk mengakses materi eksklusif dan jurnal pelatihan.</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="role" value="user">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Alamat Email</label>
                    <input type="email" name="email" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-900 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#da291c]/20 focus:border-[#da291c] transition-all" placeholder="contoh@email.com">
                    @error('email') <p class="text-red-500 text-[10px] mt-2 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2 ml-1">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400">Password</label>
                        <a href="#" class="text-[9px] font-black uppercase tracking-widest text-[#da291c] hover:underline">Lupa Password?</a>
                    </div>
                    <input type="password" name="password" required class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-slate-900 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#da291c]/20 focus:border-[#da291c] transition-all" placeholder="Masukkan password Anda">
                </div>

                <div class="flex items-center gap-3 ml-1">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-slate-200 text-[#da291c] focus:ring-[#da291c]">
                    <label for="remember" class="text-xs font-bold text-slate-500">Ingat Saya</label>
                </div>

                <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-[#da291c] transition-all shadow-xl shadow-slate-200">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-slate-100 text-center">
                <p class="text-slate-500 text-xs font-bold">Belum punya akun? <a href="{{ route('register') }}" class="text-[#da291c] hover:underline ml-1">Daftar di sini</a></p>
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
