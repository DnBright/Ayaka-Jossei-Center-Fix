<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Ayaka Josei Center</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Outfit:wght@400;700;800;900&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
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

        /* Glass Cards */
        .admin-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        @media (max-width: 1024px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-main { margin-left: 0; width: 100%; }
        }
    </style>
</head>
<body class="antialiased">
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <div class="logo-section">
                    <span class="text-[#da291c]">Ayaka</span> Josei
                </div>
            </div>
            <nav class="sidebar-nav">
                <a href="/admin" class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/artikel" class="nav-item {{ request()->is('admin/artikel*') ? 'active' : '' }}">
                    <i data-lucide="file-text"></i>
                    <span>Artikel & Berita</span>
                </a>
                <a href="/admin/ebook" class="nav-item {{ request()->is('admin/ebook*') ? 'active' : '' }}">
                    <i data-lucide="book-open"></i>
                    <span>E-Book Materi</span>
                </a>
                <a href="/admin/halaman" class="nav-item {{ request()->is('admin/halaman*') ? 'active' : '' }}">
                    <i data-lucide="layout"></i>
                    <span>Halaman & Konten</span>
                </a>
                <a href="/admin/media" class="nav-item {{ request()->is('admin/media*') ? 'active' : '' }}">
                    <i data-lucide="image"></i>
                    <span>Media & Galeri</span>
                </a>
                <a href="/admin/komunikasi" class="nav-item {{ request()->is('admin/komunikasi*') ? 'active' : '' }}">
                    <i data-lucide="message-square"></i>
                    <span>Komunikasi</span>
                </a>
                <a href="/admin/users" class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i data-lucide="users"></i>
                    <span>User & Role</span>
                </a>
                <a href="/admin/pengaturan" class="nav-item {{ request()->is('admin/pengaturan*') ? 'active' : '' }}">
                    <i data-lucide="settings"></i>
                    <span>Pengaturan</span>
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
                    <button class="lg:hidden p-2 bg-slate-100 rounded-lg">
                        <i data-lucide="menu"></i>
                    </button>
                    <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">@yield('page-title', 'Dashboard Overview')</h2>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="relative hidden md:block">
                        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 w-4 h-4"></i>
                        <input type="text" placeholder="Cari..." class="pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-[#da291c] w-64 transition-all">
                    </div>
                    
                    <button class="relative p-2 text-slate-400 hover:text-[#da291c] transition-colors">
                        <i data-lucide="bell"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-[#da291c] rounded-full border-2 border-white"></span>
                    </button>

                    <div class="flex items-center gap-3 pl-6 border-l border-slate-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-extrabold text-slate-900 leading-none">Admin User</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Super Admin</p>
                        </div>
                        <div class="w-10 h-10 bg-red-50 text-[#da291c] rounded-xl flex items-center justify-center font-black border border-red-100">
                            A
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
