@extends('layouts.app')

@section('title', 'Program - Ayaka Josei Center')

@section('content')
<div class="vangu-wrapper font-['Outfit']">
    <!-- 1. EDITORIAL HERO -->
    <header class="vangu-hero py-16 md:py-24 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="hero-text-side relative z-10 vangu-reveal text-center lg:text-left">
                    <div class="vangu-badge text-[#da291c] font-black tracking-[0.4em] text-[10px] mb-8 uppercase">Special Program Edition</div>
                    <h1 class="text-5xl md:text-7xl lg:text-[100px] leading-[0.95] md:leading-[0.9] font-black text-slate-900 tracking-tighter uppercase mb-12 italic">
                        Program <br /> <span class="text-[#da291c]">Pelatihan</span> <br /> Unggulan
                    </h1>
                    <p class="text-lg md:text-xl text-slate-500 max-w-md mx-auto lg:mx-0 leading-relaxed mb-12">
                        {{ $pages['program']->content['hero_subtitle'] ?? 'Kurikulum intensif yang dirancang untuk memenuhi standar kompetensi kerja di Jepang.' }}
                    </p>
                    <div class="flex items-center justify-center lg:justify-start gap-12">
                        <button class="bg-slate-900 text-white px-10 py-5 font-black uppercase tracking-widest text-sm hover:bg-[#da291c] transition-all transform hover:-translate-y-1">Jelajahi</button>
                        <div class="w-24 h-px bg-slate-200 relative hidden md:block">
                            <div class="absolute inset-0 bg-[#da291c] w-0 animate-[dash_2s_infinite]"></div>
                        </div>
                    </div>
                </div>
                <div class="hero-visual-side relative mt-16 lg:mt-0">
                    <div class="vangu-image-mask rounded-[30px] md:rounded-[40px] overflow-hidden shadow-2xl h-[400px] md:h-[600px] bg-slate-100">
                        <img src="{{ asset('images/hero-bg.png') }}" class="w-full h-full object-cover grayscale opacity-80" alt="Training">
                    </div>
                    <div class="absolute -bottom-6 -left-6 md:-bottom-10 md:-left-10 bg-white/80 backdrop-blur-2xl p-6 md:p-10 rounded-[20px] md:rounded-[30px] shadow-2xl border border-white/20">
                        <span class="text-3xl md:text-5xl font-black text-[#da291c] block mb-2">98%</span>
                        <span class="text-[9px] md:text-[10px] font-black text-slate-500 uppercase tracking-widest">Placement Rate</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-[-100px] right-[-100px] text-[20vw] font-black text-slate-50 opacity-[0.03] select-none pointer-events-none">PROGRAM</div>
    </header>

    <!-- 2. PENGANTAR -->
    <section class="py-20 md:py-32">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl relative text-center md:text-left">
                <div class="hidden md:block absolute -left-20 -top-10 w-64 h-80 bg-slate-50 rounded-[40px] -z-10"></div>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter mb-8 leading-tight">
                    {{ $pages['program']->content['pengantar_title'] ?? 'Membangun Keterampilan Yang Relevan Dengan Industri Jepang' }}
                </h2>
                <p class="text-xl md:text-2xl text-slate-600 font-medium leading-relaxed">
                    {{ $pages['program']->content['pengantar_subtitle'] ?? 'Setiap program di AJC didukung oleh instruktur berpengalaman dan kurikulum yang diperbarui secara berkala sesuai regulasi ketenagakerjaan Jepang.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- 3. INTERACTIVE PROGRAM PANELS -->
    <section class="py-20 md:py-32 bg-slate-900 text-white overflow-hidden">
        <div class="container mx-auto px-6 mb-16 md:mb-20 text-center">
            <span class="text-[#da291c] font-black tracking-[0.4em] text-[10px] mb-6 block uppercase">Specializations</span>
            <h2 class="text-4xl md:text-5xl lg:text-7xl font-black tracking-tighter uppercase italic leading-none">Daftar Program</h2>
        </div>

        <div class="flex flex-col lg:flex-row gap-6 container mx-auto px-6 h-auto lg:min-h-[600px]">
            @php
                $programs = [
                    ['id' => 'kaigo', 'name' => 'KAIGO (CAREGIVER)', 'desc' => 'Program pelatihan perawat lansia dengan fokus pada etika pelayanan (Omotenashi) dan teknik perawatan medis dasar.'],
                    ['id' => 'fb', 'name' => 'F&B SERVICE', 'desc' => 'Pelatihan pelayanan restoran dan pengolahan makanan dengan standar kebersihan HACCP Jepang.'],
                    ['id' => 'industri', 'name' => 'INDUSTRI', 'desc' => 'Fokus pada keterampilan teknis manufaktur, perakitan, dan kontrol kualitas produksi.'],
                    ['id' => 'hospitality', 'name' => 'HOSPITALITY', 'desc' => 'Manajemen hotel dan pelayanan pariwisata untuk mendukung industri leisure di Jepang.']
                ];
            @endphp

            @foreach($programs as $idx => $prog)
                <div class="group flex-1 lg:hover:flex-[3] bg-slate-800 rounded-[30px] md:rounded-[40px] p-8 md:p-10 relative overflow-hidden transition-all duration-700 cursor-pointer border border-white/5 hover:bg-[#da291c]">
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="flex justify-between items-center mb-10 md:mb-12">
                            <span class="text-2xl font-black opacity-20 group-hover:opacity-100 transition-opacity">0{{ $idx + 1 }}</span>
                            <div class="lg:opacity-0 lg:group-hover:opacity-100 transition-opacity bg-white/20 px-4 py-1 rounded-full text-[10px] font-black">EXPLORE</div>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-black mb-6 tracking-tighter transition-all lg:group-hover:text-5xl">{{ $prog['name'] }}</h3>
                        <div class="lg:opacity-0 lg:group-hover:opacity-100 transition-all duration-500 lg:translate-y-10 lg:group-hover:translate-y-0">
                            <p class="text-base md:text-lg opacity-80 mb-10 leading-relaxed max-w-lg">{{ $prog['desc'] }}</p>
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
    <section class="py-20 md:py-32 bg-white">
        <div class="container mx-auto px-6 flex flex-col items-center">
            <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 items-center text-center">
                <div class="lg:col-span-1 flex flex-col items-center">
                    <div class="w-40 h-40 md:w-48 md:h-48 bg-slate-900 rounded-full flex flex-col items-center justify-center text-white p-6 shadow-2xl">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-[#da291c] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04kM12 21a8.966 8.966 0 01-5.917-2.24L4 15.033V12a1 1 0 011-1h14a1 1 0 011 1v3.033l-2.083 3.727A8.966 8.966 0 0112 21z"></path></svg>
                        <span class="text-[9px] md:text-[10px] font-black uppercase tracking-widest leading-tight">Persyaratan <br /> Minimum</span>
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
                    <div class="bg-slate-50 p-6 md:p-8 rounded-[25px] md:rounded-[30px] border border-slate-100 hover:border-[#da291c] transition-colors">
                        <span class="text-[#da291c] font-black block mb-2">0{{ $idx + 1 }}</span>
                        <p class="text-base md:text-lg font-black text-slate-800 tracking-tight leading-snug">{{ $req }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. CTA -->
    <section class="py-20 md:py-24">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 min-h-auto md:min-h-[500px] rounded-[30px] md:rounded-[50px] overflow-hidden shadow-2xl">
                <div class="bg-cover bg-center grayscale h-64 md:h-auto" style="background-image: url('{{ asset('images/hero-bg.png') }}')"></div>
                <div class="bg-slate-900 p-10 md:p-16 lg:p-24 flex flex-col justify-center text-white text-center md:text-left">
                    <h2 class="text-4xl md:text-5xl font-black tracking-tighter uppercase italic mb-8 leading-none">
                        {{ $pages['program']->content['cta_title'] ?? 'Siap Memulai Karirmu?' }}
                    </h2>
                    <p class="text-lg opacity-60 mb-12">
                        {{ $pages['program']->content['cta_description'] ?? 'Dapatkan bimbingan langsung dari konsultan kami mengenai alur pendaftaran dan biaya pelatihan.' }}
                    </p>
                    <button class="bg-[#da291c] text-white px-10 md:px-12 py-4 md:py-5 rounded-full font-black uppercase tracking-widest text-xs flex items-center justify-center gap-6 w-full sm:w-fit hover:scale-105 transition-all mx-auto md:mx-0">
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
