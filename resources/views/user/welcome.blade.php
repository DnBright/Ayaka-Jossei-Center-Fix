@extends('layouts.app')

@section('title', 'Ayaka Josei Center - Lembaga Pelatihan Kerja Jepang')

@section('content')
<main class="font-['Outfit']">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center overflow-hidden bg-slate-900">
        <!-- Hero Background -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-bg.png') }}" class="w-full h-full object-cover" alt="Ayaka Hero">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl">
                <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/10 mb-8">
                    <span class="w-2 h-2 bg-[#da291c] rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white">Resmi & Terpercaya</span>
                </div>
                
                <h1 class="text-white text-5xl md:text-7xl lg:text-9xl font-black leading-[0.95] md:leading-[0.85] tracking-tighter uppercase italic mb-8">
                    Ayaka <br />
                    <span class="text-[#da291c]">Josei</span> Center
                </h1>

                <p class="text-xl md:text-2xl text-slate-300 font-medium mb-12 max-w-xl leading-relaxed">
                    Lembaga Pelatihan Kerja (LPK) Khusus Putri untuk Karir Profesional di Jepang.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <a href="/profil" class="w-full sm:w-auto bg-[#da291c] text-white px-10 py-5 rounded-full text-xs font-black uppercase tracking-widest hover:bg-white hover:text-slate-900 transition-all shadow-2xl shadow-red-500/20 text-center">
                        Pelajari Selengkapnya
                    </a>
                    <a href="/kontak" class="w-full sm:w-auto bg-white/10 backdrop-blur-md text-white border border-white/20 px-10 py-5 rounded-full text-xs font-black uppercase tracking-widest hover:bg-white/20 transition-all text-center">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Decorative Element -->
        <div class="absolute bottom-0 right-0 p-12 lg:block hidden">
            <div class="w-64 h-64 border border-white/5 rounded-full flex items-center justify-center animate-[spin_20s_linear_infinite]">
                <div class="w-48 h-48 border border-white/10 rounded-full flex items-center justify-center">
                    <div class="w-32 h-32 border border-[#da291c]/20 rounded-full"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white border-b border-slate-100">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-black text-slate-900 mb-1">500+</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Alumni Berangkat</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-slate-900 mb-1">98%</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Lulus Interview</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-slate-900 mb-1">20+</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Partner User</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-black text-slate-900 mb-1">24/7</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Dukungan Alumni</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="relative">
                    <div class="aspect-square rounded-[50px] overflow-hidden shadow-2xl relative z-10">
                        <img src="{{ asset('images/hero-bg.png') }}" class="w-full h-full object-cover grayscale" alt="Profil">
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-[#da291c]/5 rounded-full blur-3xl -z-0"></div>
                </div>
                <div class="text-center lg:text-left">
                    <span class="text-[#da291c] font-black tracking-[0.4em] uppercase text-[10px] mb-6 block">Tentang AJC</span>
                    <h2 class="text-4xl md:text-6xl font-black tracking-tighter leading-none mb-8 italic uppercase">Membangun Masa Depan di Jepang</h2>
                    <p class="text-lg text-slate-500 leading-relaxed mb-10">Ayaka Josei Center adalah lembaga pelatihan kerja spesialis putri yang berfokus pada pengembangan karir di Jepang. Kami memberikan pelatihan intensif bahasa dan keterampilan teknis untuk mencetak tenaga kerja profesional yang siap bersaing di pasar global.</p>
                    <a href="/profil" class="inline-flex items-center gap-4 text-slate-900 font-black uppercase tracking-widest text-xs group">
                        Selengkapnya Tentang Kami 
                        <svg class="w-5 h-5 text-[#da291c] group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Grid -->
    <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-6xl font-black tracking-tighter italic uppercase">Program Unggulan</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @php
                    $programs = [
                        ['title' => 'Kaigo (Caregiver)', 'desc' => 'Pelatihan perawat lansia profesional dengan standar pelayanan Jepang.'],
                        ['title' => 'F&B Service', 'desc' => 'Keterampilan pengolahan makanan dan pelayanan restoran internasional.'],
                        ['title' => 'Manufaktur', 'desc' => 'Pelatihan teknis untuk industri perakitan dan produksi di Jepang.'],
                    ];
                @endphp
                @foreach($programs as $p)
                <div class="bg-white p-12 rounded-[40px] shadow-xl hover:-translate-y-4 transition-all duration-500 border border-slate-100">
                    <div class="w-12 h-1 bg-[#da291c] mb-8"></div>
                    <h3 class="text-2xl font-black mb-4 uppercase italic tracking-tighter">{{ $p['title'] }}</h3>
                    <p class="text-slate-500 leading-relaxed mb-10">{{ $p['desc'] }}</p>
                    <a href="/program" class="text-[10px] font-black uppercase tracking-widest text-[#da291c]">Detail Program</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="bg-slate-950 rounded-[60px] p-12 md:p-24 text-center text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-96 h-96 bg-[#da291c] rounded-full blur-[150px] opacity-20 translate-x-1/2 -translate-y-1/2"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-7xl font-black tracking-tighter mb-10 italic uppercase leading-none">Siap Menjadi Bagian <br /> Dari Kesuksesan Kami?</h2>
                    <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto mb-16">Pendaftaran batch baru telah dibuka. Hubungi kami untuk konsultasi gratis mengenai karirmu di Jepang.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-6">
                        <a href="/register" class="bg-[#da291c] text-white px-12 py-5 rounded-full text-xs font-black uppercase tracking-widest hover:bg-white hover:text-slate-900 transition-all shadow-2xl">Daftar Sekarang</a>
                        <a href="/kontak" class="bg-white/10 text-white border border-white/20 px-12 py-5 rounded-full text-xs font-black uppercase tracking-widest hover:bg-white/20 transition-all">Konsultasi Gratis</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
