<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Ayaka Josei Center')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;900&family=Cormorant+Garamond:ital,wght@1,700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased font-sans text-[#0f172a] bg-white overflow-x-hidden m-0 p-0" x-data="{ mobileMenuOpen: false }">
    <!-- Navbar -->
    <nav id="navbar" class="fixed top-6 left-1/2 -translate-x-1/2 w-[90%] lg:w-fit z-50 bg-white/80 backdrop-blur-xl border border-slate-200/60 py-2.5 px-6 rounded-full shadow-2xl transition-all duration-500">
        <div class="flex items-center justify-between lg:justify-start lg:gap-8">
            <!-- Logo -->
            <a href="/" class="flex items-center h-8 hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/logo ayakan.png') }}" alt="Ayaka Logo" class="h-6 md:h-8 w-auto object-contain">
            </a>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-900 focus:outline-none relative z-[70]">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 8h16M4 16h16"></path></svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Menu Desktop -->
            <div class="hidden lg:flex items-center space-x-1">
                @php
                    $navItems = [
                        ['name' => 'Home', 'href' => '/'],
                        ['name' => 'Profil', 'href' => '/profil'],
                        ['name' => 'Program', 'href' => '/program'],
                        ['name' => 'Galeri', 'href' => '/galeri'],
                        ['name' => 'Blog', 'href' => '/blog'],
                        ['name' => 'E-Book', 'href' => '/ebook'],
                        ['name' => 'Alumni', 'href' => '/alumni'],
                        ['name' => 'Kontak', 'href' => '/kontak'],
                    ];
                @endphp
                @foreach($navItems as $item)
                    @php
                        $isActive = request()->is(trim($item['href'], '/')) || (request()->is('/') && $item['href'] == '/');
                    @endphp
                    <a href="{{ $item['href'] }}" class="px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-[0.15em] transition-all duration-300 {{ $isActive ? 'bg-[#da291c] text-white' : 'text-slate-600 hover:text-slate-900' }}">
                        {{ $item['name'] }}
                    </a>
                @endforeach
            </div>

            <!-- Auth Buttons (Desktop) -->
            <div class="hidden lg:flex items-center space-x-2 border-l border-slate-200 pl-8 ml-2">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all">Login</a>
                @endif
                <a href="/register" class="bg-slate-900 text-white px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-[#da291c] transition-all">Join AJC</a>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             @click.away="mobileMenuOpen = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="lg:hidden absolute top-[calc(100%+15px)] left-0 w-full bg-white/95 backdrop-blur-2xl rounded-[30px] border border-slate-200/60 p-8 shadow-2xl z-[60]">
            <div class="flex flex-col space-y-6">
                @foreach($navItems as $item)
                    <a href="{{ $item['href'] }}" @click="mobileMenuOpen = false" class="text-sm font-black uppercase tracking-widest {{ request()->is(trim($item['href'], '/')) ? 'text-[#da291c]' : 'text-slate-600' }}">
                        {{ $item['name'] }}
                    </a>
                @endforeach
                <hr class="border-slate-100">
                <div class="flex flex-col gap-4 pt-2">
                    <a href="/login" class="border border-slate-200 text-slate-900 py-4 px-6 rounded-2xl text-center text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Masuk Akun</a>
                    <a href="/register" class="bg-[#da291c] text-white py-4 px-6 rounded-2xl text-center text-xs font-black uppercase tracking-widest shadow-xl shadow-red-500/20">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer id="footer" class="bg-slate-950 pt-32 pb-12 text-white mt-auto relative z-10">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-16 mb-20">
                <div class="lg:col-span-2">
                    <a href="/" class="inline-block h-16 mb-8 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/logo ayakan.png') }}" alt="Logo" class="h-full object-contain">
                    </a>
                    <h3 class="text-3xl font-black italic tracking-tighter mb-4">Ayaka Josei Center</h3>
                    <p class="text-slate-500 max-w-md leading-relaxed">Membuka gerbang karir profesional di Jepang untuk perempuan Indonesia melalui pelatihan yang berkualitas dan sistem pemberangkatan yang transparan.</p>
                </div>
                <div>
                    <h4 class="text-xs font-black uppercase tracking-widest mb-8 text-white">Navigasi</h4>
                    <ul class="space-y-4 text-slate-400 font-bold text-sm">
                        <li><a href="/" class="hover:text-[#da291c] transition-colors">Home</a></li>
                        <li><a href="/profil" class="hover:text-[#da291c] transition-colors">Profil</a></li>
                        <li><a href="/program" class="hover:text-[#da291c] transition-colors">Program</a></li>
                        <li><a href="/galeri" class="hover:text-[#da291c] transition-colors">Galeri</a></li>
                        <li><a href="/blog" class="hover:text-[#da291c] transition-colors">Blog</a></li>
                        <li><a href="/alumni" class="hover:text-[#da291c] transition-colors">Alumni</a></li>
                        <li><a href="/kontak" class="hover:text-[#da291c] transition-colors">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-black uppercase tracking-widest mb-8 text-white">Kontak</h4>
                    <ul class="space-y-4 text-slate-400 font-bold text-sm">
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-[#da291c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> admin@ayakajosei.com</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-[#da291c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> +62 815 4200 7626</li>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-12 border-t border-white/5 text-slate-600 text-[10px] font-black uppercase tracking-[0.3em]">
                &copy; {{ date('Y') }} Ayaka Josei Center. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Floating Actions -->
    <div class="fixed bottom-8 right-8 z-[100] flex flex-col gap-4">
        <a href="https://wa.me/6281542007626" target="_blank" class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-2xl shadow-green-900/40 hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.767 5.767 0 1.261.405 2.422 1.096 3.369l-1.096 3.193 3.267-1.07c.92.582 2.01.928 3.181.928 3.181 0 5.767-2.586 5.767-5.767 0-3.181-2.586-5.767-5.767-5.767zm3.38 8.136c-.147.412-.729.743-1.002.793-.243.044-.56.079-1.425-.262-1.096-.433-1.802-1.545-1.857-1.618-.055-.073-.442-.587-.442-1.129 0-.541.284-.807.385-.918.101-.111.22-.138.294-.138.074 0 .147.001.211.004.067.003.158-.026.248.188.091.214.312.763.34 0 .027.214.046.303.018.067-.028.147-.042.22-.111s.303-.294.385-.385c.083-.092.166-.156.276-.064.11.092.735.361.855.421.12.06.2.091.248.174.048.083.048.48-.099.892z"></path></svg>
        </a>
        <a href="/kontak" class="w-14 h-14 bg-[#da291c] rounded-full flex items-center justify-center shadow-2xl shadow-red-900/40 hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        </a>
    </div>
</body>
</html>
