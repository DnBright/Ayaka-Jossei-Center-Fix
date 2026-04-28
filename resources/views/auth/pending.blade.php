@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#fafafa] px-6 py-20">
    <div class="max-w-2xl w-full">
        <div class="bg-white rounded-[48px] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] border border-slate-100 p-12 md:p-20 text-center relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-full -mr-32 -mt-32 blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#da291c]/5 rounded-full -ml-32 -mb-32 blur-3xl opacity-50"></div>

            <div class="relative">
                <div class="w-24 h-24 bg-slate-900 text-white rounded-3xl flex items-center justify-center mx-auto mb-10 shadow-2xl rotate-3">
                    <i data-lucide="clock" class="w-12 h-12"></i>
                </div>

                <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight mb-6">
                    Akun Sedang <span class="text-[#da291c]">Divalidasi</span>
                </h1>

                <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10 max-w-md mx-auto">
                    Terima kasih telah mendaftar. Untuk menjaga keamanan komunitas Ayaka, admin kami akan meninjau akun Anda terlebih dahulu. 
                </p>

                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 mb-12">
                    <div class="flex items-center gap-4 text-left">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#da291c] shadow-sm">
                            <i data-lucide="info" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <div class="font-bold text-slate-900">Estimasi Waktu</div>
                            <div class="text-sm text-slate-500 font-medium">Proses validasi biasanya memakan waktu 1x24 jam kerja.</div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/" class="px-10 py-5 bg-slate-900 text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl hover:-translate-y-1 transition-all">
                        Kembali ke Beranda
                    </a>
                    <a href="/kontak" class="px-10 py-5 bg-white text-slate-900 border-2 border-slate-100 rounded-2xl font-black text-sm uppercase tracking-[0.2em] hover:bg-slate-50 transition-all">
                        Hubungi Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
