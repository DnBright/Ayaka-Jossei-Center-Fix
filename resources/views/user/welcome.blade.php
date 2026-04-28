@extends('layouts.app')

@section('title', 'Ayaka Josei Center - Japanese Work Training Institute')

@section('content')
<!-- Background Layer (Hero Only) -->
<div class="fixed inset-0 z-0 pointer-events-none">
    <div id="hero-bg" class="absolute inset-0 opacity-0 transition-opacity duration-1000">
        <img src="{{ asset('images/hero-bg.png') }}" class="w-full h-full object-cover" alt="Background">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute -left-1/4 top-0 w-[80%] h-full bg-[#14b8a6]/10 blur-[150px] rounded-full"></div>
        <div class="absolute -right-1/4 bottom-0 w-[80%] h-full bg-[#da291c]/10 blur-[150px] rounded-full"></div>
    </div>
</div>

<!-- Main Content -->
<main class="relative z-10">
    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center pt-20">
        <div class="container mx-auto px-6 flex flex-col lg:flex-row items-center justify-between gap-12">
            <div class="max-w-4xl text-center lg:text-left">
                <div class="inline-block glass-light px-4 py-1.5 rounded-full text-[9px] md:text-[10px] font-black tracking-[0.3em] uppercase text-slate-200 mb-8 border border-white/20 shadow-xl">
                    Trusted Japan Career Solution
                </div>
                
                <h1 class="text-white text-5xl md:text-7xl lg:text-[100px] leading-[0.95] md:leading-[0.9] font-black uppercase italic tracking-tighter mb-8 drop-shadow-2xl">
                    <span class="block">Ayaka <span class="text-[#da291c] drop-shadow-[0_0_20px_rgba(218,41,28,0.4)]">Josei</span></span>
                    <span class="block text-white/90">Center</span>
                </h1>

                <p class="text-lg md:text-xl lg:text-2xl text-slate-200 font-medium mb-12 max-w-lg lg:mx-0 mx-auto drop-shadow-md leading-relaxed">
                    Japanese Work Training Institute for Women
                </p>

                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 md:gap-6">
                    <a href="/profil" class="w-full sm:w-auto bg-[#da291c] text-white px-8 md:px-10 py-4 md:py-5 rounded-full flex items-center justify-center space-x-4 text-xs font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-2xl shadow-red-900/50 group">
                        <span>Pelajari Selengkapnya</span>
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    
                    <a href="#" class="w-full sm:w-auto glass-light text-white px-8 py-4 md:py-5 rounded-full flex items-center justify-center space-x-4 text-xs font-black uppercase tracking-widest hover:bg-white/20 transition-all border border-white/10 shadow-xl">
                        <div class="bg-[#da291c] p-2 rounded-full shadow-inner">
                            <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"></path>
                            </svg>
                        </div>
                        <span>Play Video</span>
                    </a>
                </div>
            </div>

            <!-- Floating Badge AJC -->
            <div class="relative group lg:block hidden">
                <div class="glass-light p-12 rounded-[60px] border border-white/20 flex flex-col items-center text-center backdrop-blur-3xl shadow-2xl transform hover:rotate-3 transition-transform duration-500">
                    <div class="bg-white p-6 rounded-[35px] mb-8 shadow-2xl transform group-hover:scale-110 transition-transform">
                        <img src="{{ asset('images/logo ayakan.png') }}" alt="AJC Logo" class="w-24 h-24 object-contain">
                    </div>
                    <h3 class="text-white text-5xl font-black tracking-[0.2em] mb-3">AJC</h3>
                    <p class="text-[#da291c] text-xs font-black uppercase tracking-[0.4em]">Trusted LPK Japan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Section -->
    <section id="profil" class="py-20 md:py-32 bg-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                <!-- Visual Content -->
                <div class="w-full lg:w-1/2 relative">
                    <div class="relative z-10 rounded-[30px] md:rounded-[50px] overflow-hidden shadow-2xl">
                        <img src="{{ asset('images/hero-bg.png') }}" alt="Profil" class="w-full h-[400px] md:h-[600px] object-cover grayscale hover:grayscale-0 transition-all duration-700">
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-48 md:w-64 h-48 md:h-64 bg-[#da291c] rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                    <div class="absolute -top-10 -left-10 w-48 md:w-64 h-48 md:h-64 bg-[#14b8a6] rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                </div>
                
                <!-- Text Content -->
                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <span class="text-[#da291c] font-black tracking-[0.4em] uppercase text-[10px] mb-6 block">Siapa Kami</span>
                    <h2 class="text-4xl md:text-5xl lg:text-7xl font-black tracking-tighter leading-[0.95] md:leading-[0.9] mb-8">Empowering Women Through Japan Career</h2>
                    <p class="text-slate-500 text-base md:text-lg leading-relaxed mb-10">Ayaka Josei Center adalah lembaga pelatihan kerja spesialis putri yang berfokus pada pengembangan karir di Jepang. Kami memberikan pelatihan intensif bahasa dan keterampilan teknis (Kaigo, F&B, dll) untuk mencetak tenaga kerja profesional yang siap bersaing di pasar global.</p>
                    
                    <div class="bg-slate-50 p-6 md:p-8 rounded-3xl border-l-4 border-[#da291c] shadow-sm text-left">
                        <h4 class="text-[10px] font-black uppercase tracking-widest mb-4 text-slate-800">Tujuan Kami</h4>
                        <p class="text-slate-600 italic text-sm md:text-base">"Membuka jalan bagi perempuan Indonesia untuk meraih kemandirian ekonomi dan pengalaman internasional di Jepang melalui sistem pelatihan yang transparan dan berkualitas."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Section -->
    <section id="program" class="py-20 md:py-32 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 md:mb-20">
                <span class="text-[#da291c] font-black tracking-[0.4em] uppercase text-[10px] mb-6 block">Program Kami</span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black tracking-tighter">Bidang Pelatihan</h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                @php
                    $programs = [
                        ['name' => 'Kaigo', 'desc' => 'Perawat lansia dengan standar pelayanan Jepang yang humanis.', 'icon' => '01'],
                        ['name' => 'F&B Service', 'desc' => 'Pengolahan makanan dan pelayanan restoran standar internasional.', 'icon' => '02'],
                        ['name' => 'Industri', 'desc' => 'Pelatihan teknis manufaktur dan perakitan presisi.', 'icon' => '03'],
                        ['name' => 'Hospitality', 'desc' => 'Manajemen hotel dan pelayanan pariwisata profesional.', 'icon' => '04'],
                    ];
                @endphp
                @foreach($programs as $prog)
                    <div class="bg-white p-8 md:p-10 rounded-[30px] md:rounded-[40px] shadow-xl hover:-translate-y-4 transition-all duration-500 border border-slate-100 group text-center md:text-left">
                        <div class="text-[#da291c]/20 text-3xl md:text-4xl font-black mb-6 md:mb-8 group-hover:text-[#da291c] transition-colors">{{ $prog['icon'] }}</div>
                        <h3 class="text-xl md:text-2xl font-black mb-4">{{ $prog['name'] }}</h3>
                        <p class="text-slate-500 text-sm md:text-base leading-relaxed mb-8">{{ $prog['desc'] }}</p>
                        <button class="text-[#da291c] font-black text-[10px] uppercase tracking-widest border-b-2 border-transparent hover:border-[#da291c] transition-all">Detail Program</button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Alur Section -->
    <section id="alur" class="py-20 md:py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 md:mb-20">
                <span class="text-[#da291c] font-black tracking-[0.4em] uppercase text-[10px] mb-6 block">Transparansi</span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black tracking-tighter">Alur Program</h2>
            </div>

            <div class="max-w-4xl mx-auto space-y-10 md:space-y-12">
                @php
                    $steps = [
                        ['title' => 'Pendaftaran & Seleksi', 'desc' => 'Proses seleksi awal dokumen dan wawancara internal untuk menentukan kelayakan.'],
                        ['title' => 'Pelatihan Intensif', 'desc' => 'Pelatihan bahasa Jepang dan keterampilan teknis selama 4-6 bulan di asrama.'],
                        ['title' => 'Wawancara User', 'desc' => 'Wawancara langsung dengan perusahaan Jepang (User) untuk kontrak kerja.'],
                        ['title' => 'Keberangkatan', 'desc' => 'Pengurusan dokumen COE/Visa dan pemberangkatan ke Jepang.'],
                    ];
                @endphp
                @foreach($steps as $idx => $step)
                    <div class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left gap-6 md:gap-8 relative group">
                        <div class="w-14 h-14 md:w-16 md:h-16 bg-[#da291c] rounded-full flex items-center justify-center text-white text-xl md:text-2xl font-black shadow-2xl z-10 shrink-0 group-hover:scale-110 transition-transform">
                            {{ $idx + 1 }}
                        </div>
                        <div class="pt-1 md:pt-2">
                            <h4 class="text-xl md:text-2xl font-black mb-3">{{ $step['title'] }}</h4>
                            <p class="text-slate-500 text-base md:text-lg leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                        @if(!$loop->last)
                            <div class="hidden md:block absolute left-8 top-16 w-0.5 h-16 bg-slate-100 -z-0"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Alumni Section -->
    <section id="alumni" class="py-20 md:py-32 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 md:mb-20">
                <span class="text-[#da291c] font-black tracking-[0.4em] uppercase text-[10px] mb-6 block">Cerita Mereka</span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black tracking-tighter">Alumni AJC</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @php
                    $alumni = [
                        ['name' => 'Siti Aminah', 'quote' => 'Berkat AJC, saya sekarang bekerja di Osaka sebagai perawat lansia. Pelatihannya sangat membantu saya beradaptasi.'],
                        ['name' => 'Lestari Wahyu', 'quote' => 'Sistem transparan dan jujur. Tidak ada biaya tersembunyi, semua dijelaskan di awal dengan sangat jelas.'],
                        ['name' => 'Dewi Saputri', 'quote' => 'Sensei-senseinya sangat baik dan sabar. Saya belajar dari nol sampai bisa lulus seleksi user Jepang.'],
                    ];
                @endphp
                @foreach($alumni as $alum)
                    <div class="bg-white p-8 md:p-12 rounded-[30px] md:rounded-[50px] shadow-xl relative border border-slate-100">
                        <div class="text-[#da291c] text-5xl md:text-6xl font-serif opacity-10 absolute top-6 md:top-8 left-6 md:left-8 leading-none">“</div>
                        <p class="text-slate-600 text-base md:text-lg italic mb-10 relative z-10 leading-relaxed">{{ $alum['quote'] }}</p>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-slate-100 rounded-full flex items-center justify-center font-black text-[#da291c] text-sm md:text-base">{{ substr($alum['name'], 0, 1) }}</div>
                            <h5 class="text-base md:text-lg font-black">{{ $alum['name'] }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="cta" class="py-20">
        <div class="container mx-auto px-6">
            <div class="bg-slate-900 rounded-[30px] md:rounded-[60px] p-10 md:p-16 lg:p-24 text-center text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-64 md:w-96 h-64 md:h-96 bg-[#da291c] rounded-full filter blur-[100px] md:blur-[150px] opacity-20 translate-x-1/2 -translate-y-1/2"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-6xl lg:text-8xl font-black tracking-tighter mb-8 italic leading-none">Mulai Karirmu Sekarang</h2>
                    <p class="text-slate-400 text-lg md:text-xl lg:text-2xl max-w-2xl mx-auto mb-12 md:mb-16">Jangan lewatkan kesempatan untuk merubah masa depanmu. Daftar hari ini dan bergabunglah dengan ribuan alumni sukses kami di Jepang.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4 md:gap-6">
                        <button class="w-full sm:w-auto bg-[#da291c] text-white px-10 md:px-12 py-4 md:py-5 rounded-full text-xs font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-xl">Daftar Sekarang</button>
                        <button class="w-full sm:w-auto glass-light text-white border border-white/20 px-10 md:px-12 py-4 md:py-5 rounded-full text-xs font-black uppercase tracking-widest hover:bg-white/10 transition-all">Hubungi Kami</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    .glass-light {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
    }
    
    #hero-bg.visible {
        opacity: 1;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('hero-bg').classList.add('visible');
    });
</script>
@endsection
