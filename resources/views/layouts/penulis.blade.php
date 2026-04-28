<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penulis Dashboard - Ayaka Josei Center</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo ayakan.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Outfit:wght@400;700;800;900&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --admin-bg: #f1f5f9;
            --admin-sidebar-width: 280px;
            --admin-header-height: 80px;
            --brand-red: #da291c;
            --brand-dark: #0f172a;
        }

        body {
            background: var(--admin-bg);
            font-family: 'DM Sans', 'Inter', sans-serif;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: var(--admin-sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #0f172a;
            color: rgba(255,255,255,0.7);
            z-index: 50;
            box-shadow: 10px 0 40px rgba(0,0,0,0.1);
            border-right: 1px solid rgba(255,255,255,0.05);
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 2.5rem 2rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .logo-section {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: white;
            letter-spacing: -1px;
        }

        .sidebar-nav {
            padding: 2rem 1.2rem;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            padding: 0.9rem 1.2rem;
            border-radius: 14px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.05);
            color: white;
            padding-left: 1.5rem;
        }

        .nav-item.active {
            background: linear-gradient(135deg, #da291c 0%, #991b1b 100%);
            color: white;
            box-shadow: 0 10px 25px rgba(218, 41, 28, 0.3);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 2rem;
            background: rgba(0,0,0,0.2);
        }

        .btn-logout {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem;
            border-radius: 14px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #da291c;
            color: white;
        }

        /* Main Content */
        .admin-main {
            flex: 1;
            margin-left: var(--admin-sidebar-width);
            display: flex;
            flex-direction: column;
            width: calc(100% - var(--admin-sidebar-width));
        }

        .admin-header {
            height: var(--admin-header-height);
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid #f1f5f9;
            padding: 0 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 40;
        }

        .admin-content-wrapper {
            padding: 2rem;
            flex: 1;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
        }

        @media (max-width: 1024px) {
            .admin-main { margin-left: 0; width: 100%; }
        }
    </style>
</head>
<body class="antialiased">
    <div class="admin-layout" x-data="{ sidebarOpen: false }">
        <!-- Sidebar Backdrop (Mobile) -->
        <div x-show="sidebarOpen" 
             x-transition.opacity.duration.300ms
             class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 lg:hidden"
             @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside class="admin-sidebar transform transition-transform duration-300 lg:translate-x-0 z-50"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="sidebar-header">
                <div class="logo-section">
                    <span class="text-[#da291c]">Ayaka</span> Josei
                </div>
            </div>
            <nav class="sidebar-nav">
                <a href="/penulis" class="nav-item {{ request()->is('penulis') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/penulis/artikel" class="nav-item {{ request()->is('penulis/artikel*') ? 'active' : '' }}">
                    <i data-lucide="file-text"></i>
                    <span>Artikel Saya</span>
                </a>
                <a href="/penulis/ebook" class="nav-item {{ request()->is('penulis/ebook*') ? 'active' : '' }}">
                    <i data-lucide="book-open"></i>
                    <span>E-Book</span>
                </a>
                <a href="/penulis/media" class="nav-item {{ request()->is('penulis/media*') ? 'active' : '' }}">
                    <i data-lucide="image"></i>
                    <span>Media</span>
                </a>
                <a href="/penulis/profile" class="nav-item {{ request()->is('penulis/profile*') ? 'active' : '' }}">
                    <i data-lucide="user"></i>
                    <span>Profil Saya</span>
                </a>
            </nav>
            <div class="sidebar-footer">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i data-lucide="log-out"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="admin-main">
            <header class="admin-header">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 bg-slate-100 rounded-lg focus:outline-none hover:bg-slate-200 transition-colors">
                        <i data-lucide="menu"></i>
                    </button>
                    <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">@yield('page-title', 'Dashboard Penulis')</h2>
                </div>
                
                <div class="flex items-center gap-6">
                    <!-- Notification Dropdown -->
                    <div class="relative" x-data="{ openNotify: false }">
                        <button @click="openNotify = !openNotify" class="relative p-2 text-slate-400 hover:text-[#da291c] transition-colors focus:outline-none group">
                            <i data-lucide="bell"></i>
                            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-[#da291c] rounded-full border-2 border-white animate-pulse"></span>
                        </button>

                        <div x-show="openNotify" 
                             @click.away="openNotify = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute right-0 top-full mt-4 w-80 bg-white rounded-3xl border border-slate-100 shadow-2xl z-50 overflow-hidden">
                            
                            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                                <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest">Notifikasi</h4>
                                <span class="bg-[#da291c]/10 text-[#da291c] text-[10px] font-black px-2.5 py-1 rounded-full uppercase">2 Baru</span>
                            </div>

                            <div class="max-h-[400px] overflow-y-auto">
                                <!-- New E-book Notification -->
                                <a href="/penulis/ebook" class="flex items-start gap-4 p-5 hover:bg-slate-50 transition-all border-b border-slate-50 group">
                                    <div class="w-10 h-10 bg-indigo-50 text-indigo-500 rounded-xl flex items-center justify-center shrink-0 border border-indigo-100">
                                        <i data-lucide="book-open" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-extrabold text-slate-900 mb-1">Materi E-Book Baru</p>
                                        <p class="text-[11px] font-medium text-slate-500 leading-relaxed">Admin baru saja mengunggah panduan terbaru untuk materi Batch 15.</p>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase mt-2 block">1 Jam Lalu</span>
                                    </div>
                                </a>

                                <!-- System Update -->
                                <div class="flex items-start gap-4 p-5 hover:bg-slate-50 transition-all">
                                    <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center shrink-0 border border-emerald-100">
                                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-extrabold text-slate-900 mb-1">Keamanan Dashboard</p>
                                        <p class="text-[11px] font-medium text-slate-500 leading-relaxed">Fitur multi-guard telah aktif untuk menjamin privasi data penulis.</p>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase mt-2 block">3 Jam Lalu</span>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="block p-4 text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:bg-slate-50 hover:text-[#da291c] transition-all bg-slate-50/30">
                                Bersihkan Notifikasi
                            </a>
                        </div>
                    </div>

                    <div class="relative hidden md:block" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-3 hover:opacity-80 transition-all focus:outline-none">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-extrabold text-slate-900 leading-none">Penulis User</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Content Writer</p>
                            </div>
                            <div class="w-10 h-10 bg-red-50 text-[#da291c] rounded-xl flex items-center justify-center font-black border border-red-100 shadow-sm transition-transform">
                                P
                            </div>
                        </button>

                        <div x-show="open" @click.away="open = false" class="absolute right-0 top-full mt-4 w-64 bg-white rounded-3xl border border-slate-100 shadow-2xl z-50 overflow-hidden">
                            <div class="p-6 bg-slate-50/50 border-b border-slate-100">
                                <p class="text-sm font-black text-slate-900">Penulis User</p>
                                <p class="text-xs font-medium text-slate-400">penulis@ayakajosei.com</p>
                            </div>
                            <div class="p-3">
                                <a href="/penulis/profile" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 text-slate-600 font-bold text-xs uppercase tracking-widest transition-all">
                                    <i data-lucide="user" class="w-4 h-4"></i> Edit Profil
                                </a>
                            </div>
                            <div class="p-3 border-t border-slate-50">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-red-50 text-red-600 font-bold text-xs uppercase tracking-widest transition-all">
                                        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="admin-content-wrapper">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
