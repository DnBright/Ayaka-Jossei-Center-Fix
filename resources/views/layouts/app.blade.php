<!DOCTYPE html>
<html lang="id" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- ===== CORE SEO META ===== --}}
    <title>@yield('meta_title', ($settings->site_name ?? 'Ayaka Josei Center') . ' - LPK Khusus Putri untuk Karir Profesional di Jepang')</title>
    <meta name="description" content="@yield('meta_description', 'Ayaka Josei Center (AJC) adalah Lembaga Pelatihan Kerja (LPK) khusus putri terpercaya untuk karir profesional di Jepang. Program Kaigo, FnB, Manufaktur dengan tingkat kelulusan 98%.')">
    <meta name="keywords" content="@yield('meta_keywords', 'LPK Jepang, Ayaka Josei Center, pelatihan kerja Jepang, karir Jepang perempuan, kaigo, magang Jepang, LPK putri, tenaga kerja Jepang, berangkat kerja Jepang')">
    <meta name="author" content="Ayaka Josei Center">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- ===== OPEN GRAPH (Facebook, WhatsApp, LinkedIn) ===== --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:title" content="@yield('og_title', ($settings->site_name ?? 'Ayaka Josei Center') . ' - LPK Khusus Putri untuk Karir Profesional di Jepang')">
    <meta property="og:description" content="@yield('og_description', 'Ayaka Josei Center (AJC) adalah Lembaga Pelatihan Kerja khusus putri terpercaya untuk karir profesional di Jepang.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.png'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $settings->site_name ?? 'Ayaka Josei Center' }}">
    <meta property="og:locale" content="id_ID">

    {{-- ===== TWITTER CARD ===== --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', ($settings->site_name ?? 'Ayaka Josei Center') . ' - LPK Khusus Putri')">
    <meta name="twitter:description" content="@yield('og_description', 'Ayaka Josei Center - LPK Khusus Putri untuk Karir Profesional di Jepang.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.png'))">

    {{-- ===== FAVICON ===== --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo ayakan.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo ayakan.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;900&family=Cormorant+Garamond:ital,wght@1,700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- ===== JSON-LD STRUCTURED DATA (Organization) ===== --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "EducationalOrganization",
        "name": "Ayaka Josei Center",
        "alternateName": "AJC",
        "url": "https://ayakajosseicenter.com",
        "logo": "{{ asset('images/logo ayakan.png') }}",
        "description": "Lembaga Pelatihan Kerja (LPK) khusus putri terpercaya untuk karir profesional di Jepang. Program Kaigo, FnB, dan Manufaktur.",
        "address": {
            "@@type": "PostalAddress",
            "addressCountry": "ID"
        },
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "+62815-4200-7626",
            "contactType": "customer service",
            "availableLanguage": ["Indonesian", "Japanese"]
        },
        "sameAs": [
            "https://ayakajosseicenter.com"
        ],
        "hasOfferCatalog": {
            "@@type": "OfferCatalog",
            "name": "Program Pelatihan",
            "itemListElement": [
                {"@@type": "Offer", "itemOffered": {"@@type": "Course", "name": "Kaigo (Caregiver)"}},
                {"@@type": "Offer", "itemOffered": {"@@type": "Course", "name": "FnB Service"}},
                {"@@type": "Offer", "itemOffered": {"@@type": "Course", "name": "Manufaktur"}}
            ]
        }
    }
    </script>

    {{-- ===== EXTRA STRUCTURED DATA PER PAGE ===== --}}
    @stack('structured_data')

    <style>
        /* Hide Google Translate original UI */
        .goog-te-banner-frame.skiptranslate, .goog-te-gadget-icon { display: none !important; }
        body { top: 0px !important; }
        .goog-te-menu-value { display: none !important; }
        #google_translate_element { display: none; }
        .skiptranslate iframe { display: none !important; }
    </style>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <style>

        /* ========== ARTICLE CONTENT TYPOGRAPHY ========== */
        .article-content {
            color: #475569;
            font-size: 1.0625rem;
            line-height: 1.85;
            font-family: 'Inter', sans-serif;
        }
        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4,
        .article-content h5,
        .article-content h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -0.02em;
            margin-top: 2.5em;
            margin-bottom: 0.75em;
            line-height: 1.2;
        }
        .article-content h1 { font-size: 2.2rem; }
        .article-content h2 { font-size: 1.7rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 0.4em; }
        .article-content h3 { font-size: 1.35rem; color: #da291c; }
        .article-content h4 { font-size: 1.1rem; }
        .article-content h5 { font-size: 0.95rem; text-transform: uppercase; letter-spacing: 0.1em; }
        .article-content h6 { font-size: 0.875rem; color: #64748b; }
        .article-content p { margin-bottom: 1.5em; }
        .article-content strong { font-weight: 800; color: #0f172a; }
        .article-content em { font-style: italic; }
        .article-content a { color: #da291c; text-decoration: underline; text-underline-offset: 3px; font-weight: 600; }
        .article-content a:hover { color: #991b1b; }
        .article-content ul, .article-content ol {
            padding-left: 1.75rem;
            margin-bottom: 1.5em;
        }
        .article-content ul { list-style-type: disc; }
        .article-content ol { list-style-type: decimal; }
        .article-content li { margin-bottom: 0.5em; }
        .article-content ul li::marker { color: #da291c; }
        .article-content blockquote {
            border-left: 4px solid #da291c;
            padding: 1rem 1.5rem;
            margin: 2em 0;
            background: #fff5f5;
            border-radius: 0 12px 12px 0;
            color: #64748b;
            font-style: italic;
        }
        .article-content blockquote p { margin-bottom: 0; }
        .article-content code {
            font-family: 'Courier New', monospace;
            font-size: 0.875em;
            background: #f1f5f9;
            padding: 0.15em 0.4em;
            border-radius: 4px;
            color: #da291c;
            font-weight: 600;
        }
        .article-content pre {
            background: #0f172a;
            color: #e2e8f0;
            padding: 1.5rem;
            border-radius: 16px;
            overflow-x: auto;
            margin: 2em 0;
            font-size: 0.875rem;
        }
        .article-content pre code { background: none; color: inherit; padding: 0; }
        .article-content img {
            border-radius: 20px;
            margin: 2em auto;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            max-width: 100%;
            height: auto;
        }
        .article-content hr {
            border: none;
            border-top: 2px solid #f1f5f9;
            margin: 3em 0;
        }
        .article-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 2em 0;
            font-size: 0.9rem;
        }
        .article-content th {
            background: #0f172a;
            color: white;
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        .article-content td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f1f5f9;
            color: #64748b;
        }
        .article-content tr:nth-child(even) td { background: #f8fafc; }
        /* ========== END ARTICLE CONTENT ========== */
    </style>
</head>
<body class="antialiased font-sans text-[#0f172a] bg-white overflow-x-hidden m-0 p-0" x-data="{ mobileMenuOpen: false }">
    <!-- Navbar -->
    <nav id="navbar" class="fixed top-6 left-1/2 -translate-x-1/2 w-[90%] lg:w-fit z-50 bg-white/80 backdrop-blur-xl border border-slate-200/60 py-2.5 px-6 rounded-full shadow-2xl transition-all duration-500">
        <div class="flex items-center justify-between lg:justify-start lg:gap-8">
            <!-- Logo -->
            <a href="/" class="flex items-center h-8 hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/logo ayakan.png') }}" alt="{{ $settings->site_name ?? 'Ayaka Logo' }}" class="h-6 md:h-8 w-auto object-contain">
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
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all">Login</a>
                    @endif
                    <a href="/register" class="bg-slate-900 text-white px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest hover:bg-[#da291c] transition-all">Join AJC</a>
                @else
                    <div class="relative flex items-center gap-4" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-3 px-4 py-2 rounded-full bg-slate-50 border border-slate-200 hover:border-[#da291c]/30 transition-all group">
                            <div class="text-right hidden sm:block">
                                <p class="text-[10px] font-black text-slate-900 uppercase tracking-widest leading-none">{{ Auth::user()->name }}</p>
                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-tighter mt-1">{{ Auth::user()->role }}</p>
                            </div>
                            <div class="w-8 h-8 bg-slate-900 text-white rounded-full flex items-center justify-center font-black text-[10px] group-hover:bg-[#da291c] transition-colors">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </button>
                        
                        <!-- Dashboard Links based on Role -->
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:flex bg-slate-900 text-white px-4 py-2 rounded-full text-[9px] font-black uppercase tracking-widest hover:bg-[#da291c] transition-all items-center gap-2">
                                <i data-lucide="layout-dashboard" class="w-3 h-3"></i> Admin Panel
                            </a>
                        @elseif(Auth::user()->role === 'penulis')
                            <a href="{{ route('penulis.dashboard') }}" class="hidden sm:flex bg-slate-900 text-white px-4 py-2 rounded-full text-[9px] font-black uppercase tracking-widest hover:bg-[#da291c] transition-all items-center gap-2">
                                <i data-lucide="pen-tool" class="w-3 h-3"></i> Dashboard Penulis
                            </a>
                        @endif

                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                            @csrf
                            <button type="submit" class="bg-red-50 text-[#da291c] px-4 py-2 rounded-full text-[9px] font-black uppercase tracking-widest hover:bg-[#da291c] hover:text-white transition-all">
                                Logout
                            </button>
                        </form>

                        <!-- Dropdown Mobile/Extra -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute right-0 top-full mt-3 w-48 bg-white rounded-2xl shadow-2xl border border-slate-100 py-2 z-[100]">
                            
                            @if(Auth::user()->role === 'admin')
                                <a href="/admin" class="flex items-center gap-3 px-5 py-3 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-[#da291c]">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Admin Panel
                                </a>
                            @elseif(Auth::user()->role === 'penulis')
                                <a href="/penulis" class="flex items-center gap-3 px-5 py-3 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 hover:text-[#da291c]">
                                    <i data-lucide="pen-tool" class="w-4 h-4"></i> Writer Dashboard
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}" class="sm:hidden">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-5 py-3 text-[10px] font-black uppercase tracking-widest text-red-600 hover:bg-red-50 transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
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
                    @guest
                        <a href="/login" class="border border-slate-200 text-slate-900 py-4 px-6 rounded-2xl text-center text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Masuk Akun</a>
                        <a href="/register" class="bg-[#da291c] text-white py-4 px-6 rounded-2xl text-center text-xs font-black uppercase tracking-widest shadow-xl shadow-red-500/20">Daftar Sekarang</a>
                    @else
                        <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Selamat Datang,</p>
                            <p class="text-lg font-black text-slate-900 leading-tight mb-2">{{ Auth::user()->name }}</p>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-6">{{ Auth::user()->role }} Account</p>
                            
                            <div class="flex flex-col gap-3 mb-6">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="w-full bg-slate-900 text-white py-4 px-6 rounded-2xl text-center text-xs font-black uppercase tracking-widest transition-all flex items-center justify-center gap-3">
                                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Admin Panel
                                    </a>
                                @elseif(Auth::user()->role === 'penulis')
                                    <a href="{{ route('penulis.dashboard') }}" class="w-full bg-slate-900 text-white py-4 px-6 rounded-2xl text-center text-xs font-black uppercase tracking-widest transition-all flex items-center justify-center gap-3">
                                        <i data-lucide="pen-tool" class="w-4 h-4"></i> Dashboard Penulis
                                    </a>
                                @endif
                            </div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full border border-slate-200 text-slate-400 py-4 px-6 rounded-2xl text-center text-xs font-black uppercase tracking-widest transition-all hover:bg-red-50 hover:text-red-600 hover:border-red-100">Logout Sekarang</button>
                            </form>
                        </div>
                    @endguest
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
                    <h3 class="text-3xl font-black italic tracking-tighter mb-4">{{ $settings->site_name ?? 'Ayaka Josei Center' }}</h3>
                    <p class="text-slate-500 max-w-md leading-relaxed">{{ $settings->site_description ?? 'Membuka gerbang karir profesional di Jepang untuk perempuan Indonesia melalui pelatihan yang berkualitas dan sistem pemberangkatan yang transparan.' }}</p>
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
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-[#da291c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> {{ $settings->site_email ?? 'admin@ayakajosei.com' }}</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-[#da291c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> +62 815-4200-7626</li>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-12 border-t border-white/5 text-slate-600 text-[10px] font-black uppercase tracking-[0.3em]">
                &copy; {{ date('Y') }} {{ $settings->site_name ?? 'Ayaka Josei Center' }}. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Custom Translator UI -->
    <div x-data="translatorData()" class="fixed bottom-8 left-8 z-[100]">
        <!-- Floating Button -->
        <button @click="open = !open" class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-2xl border border-slate-100 hover:scale-110 transition-transform group relative">
            <svg class="w-6 h-6 text-slate-900 group-hover:text-[#da291c] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
            <span x-show="currentLangCode !== 'id'" x-cloak class="absolute -top-1 -right-1 w-4 h-4 bg-[#da291c] rounded-full border-2 border-white"></span>
        </button>

        <!-- Language Menu -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-10 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-10 scale-95"
             @click.outside="open = false"
             x-cloak
             class="absolute bottom-20 left-0 w-64 bg-white rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-slate-100 overflow-hidden py-4 p-2">
            
            <div class="space-y-1 max-h-[400px] overflow-y-auto custom-scrollbar">
                @php
                    $langs = [
                        ['id', 'Indonesia', '🇮🇩'],
                        ['ar', 'Arabic', '🇸🇦'],
                        ['zh-CN', 'Chinese', '🇨🇳'],
                        ['en', 'English', '🇬🇧'],
                        ['fr', 'French', '🇫🇷'],
                        ['de', 'German', '🇩🇪'],
                        ['ko', 'Korean', '🇰🇷'],
                        ['es', 'Spanish', '🇪🇸']
                    ];
                @endphp

                @foreach($langs as $l)
                    <button @click="changeLanguage('{{ $l[0] }}')" 
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl transition-all group text-left"
                            :class="currentLangCode === '{{ $l[0] }}' ? 'bg-[#da291c] text-white shadow-lg shadow-red-900/20' : 'text-slate-600 hover:bg-slate-50'">
                        <span class="text-xl">{{ $l[2] }}</span>
                        <span class="font-bold text-sm tracking-tight">{{ $l[1] }}</span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Floating Actions (Right) -->
    <div class="fixed bottom-8 right-8 z-[100] flex flex-col gap-4">
        <a href="https://wa.me/6281542007626" target="_blank" class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-2xl shadow-green-900/40 hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.767 5.767 0 1.261.405 2.422 1.096 3.369l-1.096 3.193 3.267-1.07c.92.582 2.01.928 3.181.928 3.181 0 5.767-2.586 5.767-5.767 0-3.181-2.586-5.767-5.767-5.767zm3.38 8.136c-.147.412-.729.743-1.002.793-.243.044-.56.079-1.425-.262-1.096-.433-1.802-1.545-1.857-1.618-.055-.073-.442-.587-.442-1.129 0-.541.284-.807.385-.918.101-.111.22-.138.294-.138.074 0 .147.001.211.004.067.003.158-.026.248.188.091.214.312.763.34 0 .027.214.046.303.018.067-.028.147-.042.22-.111s.303-.294.385-.385c.083-.092.166-.156.276-.064.11.092.735.361.855.421.12.06.2.091.248.174.048.083.048.48-.099.892z"></path></svg>
        </a>
        <a href="/kontak" class="w-14 h-14 bg-[#da291c] rounded-full flex items-center justify-center shadow-2xl shadow-red-900/40 hover:scale-110 transition-transform">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        </a>
    </div>

    <!-- Google Translate Engine (Hidden) -->
    <div id="google_translate_element"></div>
    <script type="text/javascript">
        function translatorData() {
            return {
                open: false,
                currentLangCode: 'id',
                init() {
                    const cookieValue = document.cookie.split('; ').find(row => row.startsWith('googtrans='));
                    if (cookieValue) {
                        const parts = cookieValue.split('/');
                        this.currentLangCode = parts[parts.length - 1] || 'id';
                    }
                }
            }
        }

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,ar,zh-CN,en,fr,de,ko,es',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }

        function changeLanguage(langCode) {
            // Set Cookie
            document.cookie = "googtrans=/id/" + langCode + "; path=/; domain=" + window.location.hostname;
            document.cookie = "googtrans=/id/" + langCode + "; path=/";
            
            // Reload to apply
            location.reload();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Global Error Notifications
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Opps...',
                text: '{{ $errors->first() }}',
                confirmButtonColor: '#da291c'
            });
        @endif

        // Global Info/Redirect Notifications
        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Akses Terbatas',
                text: '{{ session('info') }}',
                confirmButtonColor: '#da291c',
                confirmButtonText: 'Saya Mengerti'
            });
        @endif

        // Global Success/Status Notifications
        @if(session('success') || session('status'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') ?? session('status') }}',
                confirmButtonColor: '#da291c'
            });
        @endif
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    @stack('scripts')
</body>
</html>
