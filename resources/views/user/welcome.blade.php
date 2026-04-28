<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ayaka Josei Center - Japanese Work Training Institute</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-[#0f172a] bg-white overflow-x-hidden">
    <!-- Background Layer (Hero Only) -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div id="hero-bg" class="absolute inset-0 opacity-0 transition-opacity duration-1000">
            <img src="{{ asset('images/hero-bg.png') }}" class="w-full h-full object-cover" alt="Background">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute -left-1/4 top-0 w-[80%] h-full bg-[#14b8a6]/10 blur-[150px] rounded-full"></div>
            <div class="absolute -right-1/4 bottom-0 w-[80%] h-full bg-[#da291c]/10 blur-[150px] rounded-full"></div>
        </div>
    </div>

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 w-full z-50 bg-white border-b border-slate-100 py-4 shadow-sm">
        <div class="container mx-auto px-6 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center h-10 hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/logo ayakan.png') }}" alt="Ayaka Logo" class="h-8 w-auto object-contain">
            </a>

            <!-- Menu -->
            <div class="hidden lg:flex items-center space-x-2 bg-slate-50 p-1 rounded-full border border-slate-100">
                @php
                    $navItems = [
                        ['name' => 'Home', 'href' => '/'],
                        ['name' => 'Profil', 'href' => '/profil'],
                        ['name' => 'Program', 'href' => '/program'],
                        ['name' => 'Galeri', 'href' => '/galeri'],
                        ['name' => 'Blog', 'href' => '#'],
                        ['name' => 'Alumni', 'href' => '#'],
                        ['name' => 'Kontak', 'href' => '#'],
                    ];
                @endphp
                @foreach($navItems as $item)
                    <a href="{{ $item['href'] }}" class="px-5 py-2 rounded-full text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-slate-900 hover:bg-white transition-all {{ request()->is(trim($item['href'], '/')) ? 'bg-white text-slate-900 shadow-sm' : '' }}">
                        {{ $item['name'] }}
                    </a>
                @endforeach
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-3">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="px-6 py-2.5 rounded-full text-[11px] font-black uppercase tracking-widest text-slate-700 hover:bg-slate-100 transition-all">Login</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-slate-900 px-8 py-2.5 rounded-full text-[11px] font-black uppercase tracking-widest text-white hover:bg-slate-800 transition-all shadow-md">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="relative z-10">
        <!-- Hero Section -->
        <section id="home" class="min-h-screen flex items-center pt-20">
            <div class="container mx-auto px-6 flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="max-w-3xl text-center lg:text-left">
                    <div class="inline-block glass-light px-4 py-1.5 rounded-full text-[10px] font-black tracking-[0.3em] uppercase text-slate-200 mb-8 border border-white/20 shadow-xl">
                        Trusted Japan Career Solution
                    </div>
                    
                    <h1 class="text-white text-6xl lg:text-[100px] leading-[0.9] font-black uppercase italic tracking-tighter mb-8 drop-shadow-2xl">
                        <span class="block">Ayaka <span class="text-[#da291c] drop-shadow-[0_0_20px_rgba(218,41,28,0.4)]">Josei</span></span>
                        <span class="block text-white/90">Center</span>
                    </h1>

                    <p class="text-xl lg:text-2xl text-slate-200 font-medium mb-12 max-w-lg lg:mx-0 mx-auto drop-shadow-md">
                        Japanese Work Training Institute for Women
                    </p>

                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-6">
                        <a href="#profil" class="bg-[#da291c] text-white px-10 py-5 rounded-full flex items-center space-x-4 text-sm font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-2xl shadow-red-900/50 group">
                            <span>Pelajari Selengkapnya</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        
                        <a href="#" class="glass-light text-white px-8 py-5 rounded-full flex items-center space-x-4 text-sm font-black uppercase tracking-widest hover:bg-white/20 transition-all border border-white/10 shadow-xl">
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
        <section id="profil" class="py-32 bg-white relative overflow-hidden">
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row items-center gap-20">
                    <!-- Visual Content -->
                    <div class="lg:w-1/2 relative">
                        <div class="relative z-10 rounded-[50px] overflow-hidden shadow-2xl">
                            <img src="{{ asset('images/hero-bg.png') }}" alt="Profil" class="w-full h-[600px] object-cover grayscale hover:grayscale-0 transition-all duration-700">
                        </div>
                        <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-[#da291c] rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                        <div class="absolute -top-10 -left-10 w-64 h-64 bg-[#14b8a6] rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                    </div>
                    
                    <!-- Text Content -->
                    <div class="lg:w-1/2">
                        <span class="text-[#da291c] font-black tracking-[0.4em] uppercase text-xs mb-6 block">Siapa Kami</span>
                        <h2 class="text-5xl lg:text-7xl font-black tracking-tighter leading-[0.9] mb-8">Empowering Women Through Japan Career</h2>
                        <p class="text-slate-500 text-lg leading-relaxed mb-10">Ayaka Josei Center adalah lembaga pelatihan kerja spesialis putri yang berfokus pada pengembangan karir di Jepang. Kami memberikan pelatihan intensif bahasa dan keterampilan teknis (Kaigo, F&B, dll) untuk mencetak tenaga kerja profesional yang siap bersaing di pasar global.</p>
                        
                        <div class="bg-slate-50 p-8 rounded-3xl border-l-4 border-[#da291c] shadow-sm">
                            <h4 class="text-xs font-black uppercase tracking-widest mb-4 text-slate-800">Tujuan Kami</h4>
                            <p class="text-slate-600 italic">"Membuka jalan bagi perempuan Indonesia untuk meraih kemandirian ekonomi dan pengalaman internasional di Jepang melalui sistem pelatihan yang transparan dan berkualitas."</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Program Section -->
        <section id="program" class="py-32 bg-slate-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-20">
                    <span class="text-[#da291c] font-black tracking-[0.4em] uppercase text-xs mb-6 block">Program Kami</span>
                    <h2 class="text-5xl lg:text-6xl font-black tracking-tighter">Bidang Pelatihan</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @php
                        $programs = [
                            ['name' => 'Kaigo', 'desc' => 'Perawat lansia dengan standar pelayanan Jepang yang humanis.', 'icon' => '01'],
                            ['name' => 'F&B Service', 'desc' => 'Pengolahan makanan dan pelayanan restoran standar internasional.', 'icon' => '02'],
                            ['name' => 'Industri', 'desc' => 'Pelatihan teknis manufaktur dan perakitan presisi.', 'icon' => '03'],
                            ['name' => 'Hospitality', 'desc' => 'Manajemen hotel dan pelayanan pariwisata profesional.', 'icon' => '04'],
                        ];
                    @endphp
                    @foreach($programs as $prog)
                        <div class="bg-white p-10 rounded-[40px] shadow-xl hover:-translate-y-4 transition-all duration-500 border border-slate-100 group">
                            <div class="text-[#da291c]/20 text-4xl font-black mb-8 group-hover:text-[#da291c] transition-colors">{{ $prog['icon'] }}</div>
                            <h3 class="text-2xl font-black mb-4">{{ $prog['name'] }}</h3>
                            <p class="text-slate-500 leading-relaxed mb-8">{{ $prog['desc'] }}</p>
                            <button class="text-[#da291c] font-black text-xs uppercase tracking-widest border-b-2 border-transparent hover:border-[#da291c] transition-all">Detail Program</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Alur Section -->
        <section id="alur" class="py-32 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-20">
                    <span class="text-[#da291c] font-black tracking-[0.4em] uppercase text-xs mb-6 block">Transparansi</span>
                    <h2 class="text-5xl lg:text-6xl font-black tracking-tighter">Alur Program</h2>
                </div>

                <div class="max-w-5xl mx-auto space-y-12">
                    @php
                        $steps = [
                            ['title' => 'Pendaftaran & Seleksi', 'desc' => 'Proses seleksi awal dokumen dan wawancara internal untuk menentukan kelayakan.'],
                            ['title' => 'Pelatihan Intensif', 'desc' => 'Pelatihan bahasa Jepang dan keterampilan teknis selama 4-6 bulan di asrama.'],
                            ['title' => 'Wawancara User', 'desc' => 'Wawancara langsung dengan perusahaan Jepang (User) untuk kontrak kerja.'],
                            ['title' => 'Keberangkatan', 'desc' => 'Pengurusan dokumen COE/Visa dan pemberangkatan ke Jepang.'],
                        ];
                    @endphp
                    @foreach($steps as $idx => $step)
                        <div class="flex items-start gap-8 relative group">
                            <div class="w-16 h-16 bg-[#da291c] rounded-full flex items-center justify-center text-white text-2xl font-black shadow-2xl z-10 shrink-0 group-hover:scale-110 transition-transform">
                                {{ $idx + 1 }}
                            </div>
                            <div class="pt-2">
                                <h4 class="text-2xl font-black mb-3">{{ $step['title'] }}</h4>
                                <p class="text-slate-500 text-lg">{{ $step['desc'] }}</p>
                            </div>
                            @if(!$loop->last)
                                <div class="absolute left-8 top-16 w-0.5 h-16 bg-slate-100 -z-0"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Alumni Section -->
        <section id="alumni" class="py-32 bg-slate-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-20">
                    <span class="text-[#da291c] font-black tracking-[0.4em] uppercase text-xs mb-6 block">Cerita Mereka</span>
                    <h2 class="text-5xl lg:text-6xl font-black tracking-tighter">Alumni AJC</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                        $alumni = [
                            ['name' => 'Siti Aminah', 'quote' => 'Berkat AJC, saya sekarang bekerja di Osaka sebagai perawat lansia. Pelatihannya sangat membantu saya beradaptasi.'],
                            ['name' => 'Lestari Wahyu', 'quote' => 'Sistem transparan dan jujur. Tidak ada biaya tersembunyi, semua dijelaskan di awal dengan sangat jelas.'],
                            ['name' => 'Dewi Saputri', 'quote' => 'Sensei-senseinya sangat baik dan sabar. Saya belajar dari nol sampai bisa lulus seleksi user Jepang.'],
                        ];
                    @endphp
                    @foreach($alumni as $alum)
                        <div class="bg-white p-12 rounded-[50px] shadow-xl relative border border-slate-100">
                            <div class="text-[#da291c] text-6xl font-serif opacity-10 absolute top-8 left-8 leading-none">“</div>
                            <p class="text-slate-600 text-lg italic mb-10 relative z-10 leading-relaxed">{{ $alum['quote'] }}</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center font-black text-[#da291c]">{{ substr($alum['name'], 0, 1) }}</div>
                                <h5 class="text-lg font-black">{{ $alum['name'] }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section id="cta" class="py-20">
            <div class="container mx-auto px-6">
                <div class="bg-slate-900 rounded-[60px] p-16 lg:p-24 text-center text-white relative overflow-hidden shadow-2xl">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-[#da291c] rounded-full filter blur-[150px] opacity-20 translate-x-1/2 -translate-y-1/2"></div>
                    <div class="relative z-10">
                        <h2 class="text-5xl lg:text-8xl font-black tracking-tighter mb-8 italic">Mulai Karirmu Sekarang</h2>
                        <p class="text-slate-400 text-xl lg:text-2xl max-w-2xl mx-auto mb-16">Jangan lewatkan kesempatan untuk merubah masa depanmu. Daftar hari ini dan bergabunglah dengan ribuan alumni sukses kami di Jepang.</p>
                        <div class="flex flex-wrap justify-center gap-6">
                            <button class="bg-[#da291c] text-white px-12 py-5 rounded-full text-sm font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-xl">Daftar Sekarang</button>
                            <button class="glass-light text-white border border-white/20 px-12 py-5 rounded-full text-sm font-black uppercase tracking-widest hover:bg-white/10 transition-all">Hubungi Kami</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="footer" class="bg-slate-950 pt-32 pb-12 text-white">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-16 mb-20">
                    <div class="lg:col-span-2">
                        <img src="{{ asset('images/logo ayakan.png') }}" alt="Logo" class="h-16 mb-8 brightness-0 invert">
                        <h3 class="text-3xl font-black italic tracking-tighter mb-4">Ayaka Josei Center</h3>
                        <p class="text-slate-500 max-w-md leading-relaxed">Membuka gerbang karir profesional di Jepang untuk perempuan Indonesia melalui pelatihan yang berkualitas dan sistem pemberangkatan yang transparan.</p>
                    </div>
                    <div>
                        <h4 class="text-xs font-black uppercase tracking-widest mb-8 text-white">Navigasi</h4>
                        <ul class="space-y-4 text-slate-400 font-bold text-sm">
                            <li><a href="#home" class="hover:text-[#da291c] transition-colors">Home</a></li>
                            <li><a href="#profil" class="hover:text-[#da291c] transition-colors">Profil</a></li>
                            <li><a href="#program" class="hover:text-[#da291c] transition-colors">Program</a></li>
                            <li><a href="#blog" class="hover:text-[#da291c] transition-colors">Blog</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xs font-black uppercase tracking-widest mb-8 text-white">Kontak</h4>
                        <ul class="space-y-4 text-slate-400 font-bold text-sm">
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-[#da291c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> admin@ayakajosei.com</li>
                            <li class="flex items-center gap-3"><svg class="w-4 h-4 text-[#da291c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> +62 812 3456 789</li>
                        </ul>
                        <div class="mt-8 pt-8 border-t border-white/5">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-600">PT Ayaka Global Indonesia • Izin SO No. 123/2026</p>
                        </div>
                    </div>
                </div>
                <div class="text-center pt-12 border-t border-white/5 text-slate-600 text-[10px] font-black uppercase tracking-[0.3em]">
                    &copy; 2026 Ayaka Josei Center. All Rights Reserved.
                </div>
            </div>
        </footer>
    </main>

    <!-- Floating Actions -->
    <div class="fixed bottom-8 right-8 z-[100] flex flex-col gap-4">
        <a href="#" class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-2xl shadow-green-900/40 hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.767 5.767 0 1.261.405 2.422 1.096 3.369l-1.096 3.193 3.267-1.07c.92.582 2.01.928 3.181.928 3.181 0 5.767-2.586 5.767-5.767 0-3.181-2.586-5.767-5.767-5.767zm3.38 8.136c-.147.412-.729.743-1.002.793-.243.044-.56.079-1.425-.262-1.096-.433-1.802-1.545-1.857-1.618-.055-.073-.442-.587-.442-1.129 0-.541.284-.807.385-.918.101-.111.22-.138.294-.138.074 0 .147.001.211.004.067.003.158-.026.248.188.091.214.312.763.34 0 .027.214.046.303.018.067-.028.147-.042.22-.111s.303-.294.385-.385c.083-.092.166-.156.276-.064.11.092.735.361.855.421.12.06.2.091.248.174.048.083.048.48-.099.892z"></path></svg>
        </a>
        <a href="#" class="w-14 h-14 bg-[#da291c] rounded-full flex items-center justify-center shadow-2xl shadow-red-900/40 hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        </a>
    </div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('hero-bg').classList.add('visible');
        });
    </script>
</body>
</html>
