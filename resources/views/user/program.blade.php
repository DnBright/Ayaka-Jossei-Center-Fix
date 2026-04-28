@extends('layouts.app')

@section('title', 'Program - Ayaka Josei Center')

@section('content')
<div class="vangu-wrapper font-['Outfit']">
    <!-- 1. EDITORIAL HERO -->
    <header class="vangu-hero py-24 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="hero-text-side relative z-10 vangu-reveal">
                    <div class="vangu-badge text-[#da291c] font-black tracking-[0.4em] text-[10px] mb-8 uppercase">Special Program Edition</div>
                    <h1 class="text-7xl lg:text-[100px] leading-[0.9] font-black text-slate-900 tracking-tighter uppercase mb-12">
                        Program <br /> <span class="text-[#da291c]">Pelatihan</span> <br /> Unggulan
                    </h1>
                    <p class="text-xl text-slate-500 max-w-md leading-relaxed mb-12">
                        Kurikulum intensif yang dirancang untuk memenuhi standar kompetensi kerja di Jepang.
                    </p>
                    <div class="flex items-center gap-12">
                        <button class="bg-slate-900 text-white px-10 py-5 font-black uppercase tracking-widest text-sm hover:bg-[#da291c] transition-all transform hover:-translate-y-1">Jelajahi</button>
                        <div class="w-24 h-px bg-slate-200 relative hidden md:block">
                            <div class="absolute inset-0 bg-[#da291c] w-0 animate-[dash_2s_infinite]"></div>
                        </div>
                    </div>
                </div>
                <div class="hero-visual-side relative">
                    <div class="vangu-image-mask rounded-[40px] overflow-hidden shadow-2xl h-[600px] bg-slate-100">
                        <img src="{{ asset('images/hero-bg.png') }}" class="w-full h-full object-cover grayscale opacity-80" alt="Training">
                    </div>
                    <div class="absolute -bottom-10 -left-10 bg-white/80 backdrop-blur-2xl p-10 rounded-[30px] shadow-2xl border border-white/20">
                        <span class="text-5xl font-black text-[#da291c] block mb-2">98%</span>
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Placement Rate</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-[-100px] right-[-100px] text-[20vw] font-black text-slate-50 opacity-[0.03] select-none pointer-events-none">PROGRAM</div>
    </header>

    <!-- 2. PENGANTAR -->
    <section class="py-32">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl relative">
                <div class="absolute -left-20 -top-10 w-64 h-80 bg-slate-50 rounded-[40px] -z-10"></div>
                <h2 class="text-5xl font-black text-slate-900 tracking-tighter mb-8 leading-tight">Membangun Keterampilan Yang Relevan Dengan Industri Jepang</h2>
                <p class="text-2xl text-slate-600 font-medium leading-relaxed">
                    Setiap program di AJC didukung oleh instruktur berpengalaman dan kurikulum yang diperbarui secara berkala sesuai regulasi ketenagakerjaan Jepang.
                </p>
            </div>
        </div>
    </section>

    <!-- 3. INTERACTIVE PROGRAM PANELS -->
    <section class="py-32 bg-slate-900 text-white overflow-hidden">
        <div class="container mx-auto px-6 mb-20 text-center">
            <span class="text-[#da291c] font-black tracking-[0.4em] text-[10px] mb-6 block uppercase">Specializations</span>
            <h2 class="text-5xl lg:text-7xl font-black tracking-tighter uppercase italic">Daftar Program</h2>
        </div>

        <div class="flex flex-col lg:flex-row gap-6 container mx-auto px-6 h-auto lg:h-[600px]">
            @php
                $programs = [
                    ['id' => 'kaigo', 'name' => 'KAIGO (CAREGIVER)', 'desc' => 'Program pelatihan perawat lansia dengan fokus pada etika pelayanan (Omotenashi) dan teknik perawatan medis dasar.'],
                    ['id' => 'fb', 'name' => 'F&B SERVICE', 'desc' => 'Pelatihan pelayanan restoran dan pengolahan makanan dengan standar kebersihan HACCP Jepang.'],
                    ['id' => 'industri', 'name' => 'INDUSTRI', 'desc' => 'Fokus pada keterampilan teknis manufaktur, perakitan, dan kontrol kualitas produksi.'],
                    ['id' => 'hospitality', 'name' => 'HOSPITALITY', 'desc' => 'Manajemen hotel dan pelayanan pariwisata untuk mendukung industri leisure di Jepang.']
                ];
            @endphp

            @foreach($programs as $idx => $prog)
                <div class="group flex-1 lg:hover:flex-[3] bg-slate-800 rounded-[40px] p-10 relative overflow-hidden transition-all duration-700 cursor-pointer border border-white/5 hover:bg-[#da291c]">
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="flex justify-between items-center mb-12">
                            <span class="text-2xl font-black opacity-20 group-hover:opacity-100 transition-opacity">0{{ $idx + 1 }}</span>
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity bg-white/20 px-4 py-1 rounded-full text-[10px] font-black">EXPLORE</div>
                        </div>
                        <h3 class="text-3xl font-black mb-6 tracking-tighter transition-all group-hover:text-5xl">{{ $prog['name'] }}</h3>
                        <div class="opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-10 group-hover:translate-y-0">
                            <p class="text-lg opacity-80 mb-10 leading-relaxed max-w-lg">{{ $prog['desc'] }}</p>
                            <div class="pt-8 border-t border-white/20">
                                <span class="text-[10px] font-black uppercase tracking-widest opacity-60 block mb-2">Target Kompetensi</span>
                                <p class="text-sm font-bold">Sertifikat JLPT N4 / JFT-Basic & Sertifikat Teknis (Tokutei Ginou)</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 4. PERSYARATAN -->
    <section class="py-32 bg-white">
        <div class="container mx-auto px-6 flex flex-col items-center">
            <div class="w-full max-w-5xl grid md:grid-cols-2 lg:grid-cols-3 gap-8 items-center">
                <div class="lg:col-span-1 flex flex-col items-center text-center">
                    <div class="w-48 h-48 bg-slate-900 rounded-full flex flex-col items-center justify-center text-white p-6 shadow-2xl">
                        <svg class="w-10 h-10 text-[#da291c] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04kM12 21a8.966 8.966 0 01-5.917-2.24L4 15.033V12a1 1 0 011-1h14a1 1 0 011 1v3.033l-2.083 3.727A8.966 8.966 0 0112 21z"></path></svg>
                        <span class="text-[10px] font-black uppercase tracking-widest leading-tight">Persyaratan <br /> Minimum</span>
                    </div>
                </div>
                @php
                    $reqs = [
                        'Wanita, Usia 18 - 28 Tahun',
                        'Pendidikan Minimal SMA/SMK Sederajat',
                        'Tinggi Badan Minimal 150 cm',
                        'Sehat Jasmani & Rohani',
                        'Tidak Memiliki Tato atau Bekas Tindik Berlebih'
                    ];
                @endphp
                @foreach($reqs as $idx => $req)
                    <div class="bg-slate-50 p-8 rounded-[30px] border border-slate-100 hover:border-[#da291c] transition-colors">
                        <span class="text-[#da291c] font-black block mb-2">0{{ $idx + 1 }}</span>
                        <p class="text-lg font-black text-slate-800 tracking-tight">{{ $req }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. CTA -->
    <section class="py-24">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 min-h-[500px] rounded-[50px] overflow-hidden shadow-2xl">
                <div class="bg-cover bg-center grayscale" style="background-image: url('{{ asset('images/hero-bg.png') }}')"></div>
                <div class="bg-slate-900 p-16 lg:p-24 flex flex-col justify-center text-white">
                    <span class="text-[#da291c] font-black tracking-[0.4em] text-[10px] mb-8 uppercase">Konsultasi Gratis</span>
                    <h2 class="text-5xl font-black tracking-tighter uppercase italic mb-8">Siap Memulai Karirmu?</h2>
                    <p class="text-xl opacity-60 mb-12">Dapatkan bimbingan langsung dari konsultan kami mengenai alur pendaftaran dan biaya pelatihan.</p>
                    <button class="bg-[#da291c] text-white px-12 py-5 rounded-full font-black uppercase tracking-widest text-sm flex items-center gap-6 w-fit hover:scale-105 transition-all">
                        Hubungi Kami <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes dash {
        0% { transform: translateX(0); width: 0; }
        50% { transform: translateX(30px); width: 40px; }
        100% { transform: translateX(100px); width: 0; }
    }
    .vangu-reveal {
        opacity: 0;
        transform: translateY(30px);
        animation: reveal 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes reveal {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
