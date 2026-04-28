<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penulis Login - Ayaka Josei Center</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo ayakan.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;800;900&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0;
        }

        .bg-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 32px 32px;
            z-index: 0;
        }

        .login-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 48px;
            padding: 4rem;
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 10;
            box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 0.05);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .logo-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 2.2rem;
            color: #0f172a;
            letter-spacing: -1.5px;
        }

        .brand-red { color: #da291c; }

        .input-group {
            margin-bottom: 1.8rem;
        }

        .input-group label {
            display: block;
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            margin-bottom: 0.8rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: #cbd5e1;
            width: 18px;
            height: 18px;
        }

        .input-wrapper input {
            width: 100%;
            background: #f1f5f9;
            border: 2px solid transparent;
            border-radius: 24px;
            padding: 1.2rem 1.5rem 1.2rem 3.8rem;
            color: #0f172a;
            font-size: 1rem;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: #da291c;
            background: white;
            box-shadow: 0 15px 30px rgba(218, 41, 28, 0.08);
        }

        .btn-login {
            width: 100%;
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 24px;
            padding: 1.3rem;
            font-size: 0.95rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 3px;
            cursor: pointer;
            margin-top: 1rem;
            transition: all 0.4s;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        }

        .btn-login:hover {
            background: #da291c;
            transform: translateY(-4px);
            box-shadow: 0 25px 50px rgba(218, 41, 28, 0.25);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 2.5rem;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .back-link:hover {
            color: #0f172a;
        }

        .role-badge {
            background: #fef2f2;
            color: #da291c;
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="bg-pattern"></div>

    <div class="login-card">
        <div class="logo-section">
            <div class="role-badge">Content Creator Hub</div>
            <h1 class="logo-text">Ayaka<span class="brand-red">Journal</span></h1>
            <p style="color: #64748b; font-weight: 600; margin-top: 0.5rem; font-size: 0.9rem;">Author & Editor Access Point</p>
        </div>

        <form action="/login" method="POST">
            @csrf
            <input type="hidden" name="role" value="penulis">

            <div class="input-group">
                <label>Writer Identity</label>
                <div class="input-wrapper">
                    <i data-lucide="user"></i>
                    <input type="email" name="email" placeholder="email@ayakajosei.com" required>
                </div>
            </div>

            <div class="input-group">
                <label>Access Token (Password)</label>
                <div class="input-wrapper">
                    <i data-lucide="key"></i>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">Start Writing</button>
        </form>

        <a href="/" class="back-link">← Back to Portal</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        lucide.createIcons();

        // Notifikasi Error Login
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: '{{ $errors->first() }}',
                background: '#ffffff',
                confirmButtonColor: '#da291c',
                borderRadius: '24px',
                customClass: {
                    popup: 'rounded-[32px]',
                    confirmButton: 'rounded-xl font-bold uppercase tracking-widest text-xs px-8 py-4'
                }
            });
        @endif

        // Notifikasi Pesan Status (misal: akun belum disetujui)
        @if(session('status'))
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: '{{ session('status') }}',
                confirmButtonColor: '#0f172a'
            });
        @endif
    </script>
</body>
</html>
