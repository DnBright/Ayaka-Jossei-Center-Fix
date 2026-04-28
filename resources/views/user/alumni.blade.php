@extends('layouts.app')

@section('title', 'Alumni - Ayaka Josei Center')

@section('content')
<div class="circle-wrapper font-['Outfit']">
    <!-- 1. DYNAMIC SPHERE HERO -->
    <header class="circle-hero-vangu min-h-screen flex items-center pt-24 md:pt-32 pb-16 md:pb-20 relative overflow-hidden bg-white">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-[-100px] left-[-100px] w-[300px] md:w-[600px] h-[300px] md:h-[600px] bg-[#da291c]/5 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-[100px] right-0 w-[200px] md:w-[400px] h-[200px] md:h-[400px] bg-blue-500/5 rounded-full blur-[120px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-24 items-center">
                <div class="hero-text-vangu circle-reveal text-center lg:text-left">
                    <div class="inline-flex items-center gap-3 bg-slate-50 px-6 py-3 rounded-full text-[10px] font-black tracking-widest text-slate-900 mb-10 border border-slate-100 shadow-sm">
                        <svg class="w-4 h-4 text-[#da291c]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                        COMMUNITY OF EXCELLENCE
                    </div>
                    <h1 class="text-5xl md:text-8xl lg:text-[130px] font-black leading-[0.95] md:leading-[0.85] text-slate-900 tracking-tighter mb-10 italic uppercase">Jejak <br /> <span class="text-[#da291c]">Sukses</span> Kami</h1>
                    <div class="w-20 h-1.5 bg-[#da291c] mb-10 mx-auto lg:mx-0"></div>
                    <p class="text-xl md:text-2xl text-slate-500 leading-tight max-w-md mx-auto lg:mx-0 mb-12">Kisah inspiratif dari para alumni Ayaka Josei Center yang kini telah berkarir secara profesional di Jepang.</p>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-12">
                        <button class="w-full sm:w-auto bg-slate-900 text-white px-12 py-5 rounded-full font-black uppercase tracking-widest text-sm hover:bg-[#da291c] transition-all shadow-2xl">Gabung Sekarang</button>
                        <div class="flex items-center -space-x-4">
                            @for($i = 1; $i <= 4; $i++)
                                <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-200"></div>
                            @endfor
                            <div class="pl-8 text-[10px] font-black text-slate-900 uppercase tracking-widest">+500 Alumni</div>
                        </div>
                    </div>
                </div>

                <div class="hero-visual-sphere circle-reveal flex justify-center mt-16 lg:mt-0">
                    <div class="w-[300px] h-[300px] md:w-[400px] md:h-[400px] bg-white border border-slate-100 rounded-full flex items-center justify-center relative shadow-2xl">
                        <svg class="w-24 h-24 md:w-32 md:h-32 text-[#da291c]/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        
                        <!-- Orbiting Profiles (Static placeholders) -->
                        <div class="absolute top-[-20px] left-0 bg-white p-3 rounded-full flex items-center gap-4 shadow-xl border border-slate-50 animate-bounce">
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-slate-100"></div>
                            <div><span class="block text-xs md:text-sm font-black">Sarah Amara</span><p class="text-[8px] md:text-[9px] font-black text-[#da291c]">OSAKA, JAPAN</p></div>
                        </div>
                        <div class="absolute bottom-[40px] right-[-40px] bg-white p-3 rounded-full flex items-center gap-4 shadow-xl border border-slate-50">
                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-slate-100"></div>
                            <div><span class="block text-xs md:text-sm font-black">Lestari P.</span><p class="text-[8px] md:text-[9px] font-black text-[#da291c]">TOKYO, JAPAN</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- 2. MARQUEE TESTIMONIALS -->
    <section class="py-20 md:py-32 bg-slate-900 text-white overflow-hidden">
        <h2 class="text-4xl md:text-5xl font-black text-center mb-16 md:mb-20 tracking-tighter italic uppercase">Suara <span class="text-[#da291c]">Alumni</span> Kami</h2>
        
        <div class="marquee-track flex gap-8 animate-[marquee_60s_linear_infinite] w-fit mb-12">
            @for($i = 1; $i <= 10; $i++)
                <div class="min-w-[300px] md:min-w-[450px] bg-white/5 border border-white/10 p-8 md:p-12 rounded-[30px] md:rounded-[40px]">
                    <svg class="w-8 h-8 md:w-10 md:h-10 text-[#da291c] mb-6 md:mb-8" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017V14C19.017 11.7909 17.2261 10 15.017 10H14.017V7H15.017C18.883 7 22.017 10.134 22.017 14V21H14.017ZM2.017 21L2.017 18C2.017 16.8954 2.91243 16 4.017 16H7.017V14C7.017 11.7909 5.22612 10 3.017 10H2.017V7H3.017C6.88297 7 10.017 10.134 10.017 14V21H2.017Z"></path></svg>
                    <p class="text-lg md:text-xl italic font-medium opacity-80 leading-relaxed mb-8 md:mb-10">"Sistem pelatihan di AJC sangat disiplin namun tetap mengutamakan kekeluargaan. Saya merasa sangat siap saat bekerja di panti lansia Tokyo."</p>
                    <div><strong class="block text-base md:text-lg font-black">Alumni Batch {{ $i }}</strong><span class="text-[10px] font-black text-[#da291c] uppercase tracking-widest">Program Kaigo</span></div>
                </div>
            @endfor
        </div>
    </section>

    <!-- 3. BENTO STORIES -->
    <section class="py-20 md:py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="mb-12 md:mb-20 circle-reveal text-center md:text-left">
                <span class="text-[#da291c] font-black tracking-[0.4em] text-[10px] mb-6 block uppercase">Success Stories</span>
                <h2 class="text-4xl md:text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter leading-none italic uppercase">Cerita Perjalanan</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-10">
                <div class="lg:col-span-2 bg-slate-50 p-8 md:p-16 rounded-[30px] md:rounded-[50px] border border-slate-100 relative overflow-hidden circle-reveal">
                    <div class="relative z-10">
                        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-10">
                            <span class="text-[10px] font-black text-[#da291c] tracking-widest">LONG READ</span>
                            <span class="text-slate-400 font-bold text-xs">Oleh: Siti Aminah</span>
                        </div>
                        <h3 class="text-3xl md:text-5xl font-black text-slate-900 mb-8 leading-tight tracking-tighter italic uppercase">Perjalanan Menuju Kyoto: Dari Desa Untuk Jepang</h3>
                        <p class="text-lg md:text-xl text-slate-500 leading-relaxed mb-12">Kisah bagaimana seorang putri daerah dari Malang berhasil menembus seleksi ketat perusahaan Kaigo di Kyoto melalui program beasiswa AJC.</p>
                        <button class="flex items-center gap-4 text-slate-900 font-black uppercase tracking-widest text-xs hover:text-[#da291c] transition-colors">Baca Cerita Lengkap <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"></path></svg></button>
                    </div>
                </div>
                <div class="bg-slate-900 text-white p-10 md:p-12 rounded-[30px] md:rounded-[50px] flex flex-col justify-center text-center circle-reveal">
                    <div class="mb-8 flex justify-center"><svg class="w-12 h-12 md:w-16 md:h-16 text-[#da291c]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path></svg></div>
                    <h4 class="text-xl md:text-2xl font-black mb-4">Ingin Menjadi Seperti Mereka?</h4>
                    <p class="text-sm md:text-base text-slate-400 mb-8 leading-relaxed">Setiap perjalanan besar dimulai dari satu langkah kecil. Mulailah langkahmu hari ini.</p>
                    <button class="bg-[#da291c] text-white py-4 rounded-full font-black uppercase tracking-widest text-[10px] hover:scale-105 transition-transform">Daftar Sekarang</button>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. DIRECTORY GRID -->
    <section class="py-20 md:py-32 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row justify-between items-center border-b-2 border-slate-900 pb-12 mb-16 md:mb-20">
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter italic uppercase text-center md:text-left leading-none">Direktori Alumni</h2>
                <div class="flex flex-wrap justify-center gap-6 md:gap-8 mt-10 lg:mt-0">
                    <button class="text-[10px] font-black uppercase tracking-widest text-[#da291c] border-b-2 border-[#da291c]">Semua</button>
                    <button class="text-[10px] font-black uppercase tracking-widest text-slate-400">Di Jepang</button>
                    <button class="text-[10px] font-black uppercase tracking-widest text-slate-400">Proses COE</button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 md:gap-12">
                @for($i = 1; $i <= 8; $i++)
                    <div class="circle-reveal group text-center md:text-left">
                        <div class="aspect-square bg-slate-200 rounded-3xl overflow-hidden mb-6 md:mb-8 relative">
                            <img src="{{ asset('images/hero-bg.png') }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" alt="Alumni">
                            <div class="absolute inset-0 bg-[#da291c]/90 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </div>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="bg-green-100 text-green-800 text-[8px] font-black uppercase px-2 py-1 rounded">ALUMNI</span>
                            <span class="text-slate-300 font-black text-xs">'24</span>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-1">Rizky Amanda</h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest flex items-center justify-center md:justify-start gap-2"><svg class="w-3 h-3 text-[#da291c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg> TOKYO, JAPAN</p>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- 5. FINAL CTA -->
    <footer class="py-20 md:py-32 bg-slate-50 text-center">
        <div class="container mx-auto px-6">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-slate-900 text-white rounded-full flex items-center justify-center text-3xl md:text-4xl font-black mx-auto mb-12 md:mb-16 circle-reveal">A</div>
            <h2 class="text-4xl md:text-5xl lg:text-7xl font-black text-slate-900 tracking-tighter leading-none mb-10 md:mb-12 circle-reveal italic uppercase">Jadilah Bagian Dari <br /> Keluarga Besar Kami</h2>
            <button class="w-full sm:w-auto bg-[#da291c] text-white px-12 md:px-16 py-5 md:py-6 rounded-full font-black uppercase tracking-widest text-[10px] md:text-sm flex items-center justify-center gap-6 mx-auto hover:bg-slate-900 transition-all shadow-2xl circle-reveal">
                Mulai Suksesmu <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </button>
            <div class="mt-16 md:mt-24 flex flex-wrap items-center justify-center gap-6 md:gap-8 opacity-20 font-black text-[8px] md:text-[10px] tracking-[0.4em] circle-reveal">
                <span>ARCHIVE SERIES</span>
                <span class="w-1.5 h-1.5 bg-slate-900 rounded-full"></span>
                <span>VERSION 2026.01</span>
                <span class="w-1.5 h-1.5 bg-slate-900 rounded-full"></span>
                <span>AYAKA LPK CENTER</span>
            </div>
        </div>
    </footer>
</div>

<style>
    @keyframes marquee {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }
    .circle-reveal {
        opacity: 0;
        transform: translateY(30px);
        animation: reveal 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes reveal {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
