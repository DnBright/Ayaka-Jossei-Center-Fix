<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Ayaka Josei Center</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo ayakan.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;800;900&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0;
        }

        .login-blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #da291c 0%, #7f1d1d 100%);
            filter: blur(120px);
            border-radius: 50%;
            opacity: 0.2;
            z-index: 0;
        }

        .blob-1 { top: -100px; right: -100px; }
        .blob-2 { bottom: -100px; left: -100px; }

        .login-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 4rem;
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 10;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.5);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .logo-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 2.5rem;
            color: white;
            letter-spacing: -2px;
        }

        .brand-red { color: #da291c; }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group label {
            display: block;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.75rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.3);
            width: 18px;
            height: 18px;
        }

        .input-wrapper input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 18px;
            padding: 1.1rem 1.25rem 1.1rem 3.5rem;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: #da291c;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 4px rgba(218, 41, 28, 0.15);
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #da291c 0%, #b91c1c 100%);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 1.25rem;
            font-size: 1rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            margin-top: 1.5rem;
            transition: all 0.3s;
            box-shadow: 0 20px 40px rgba(218, 41, 28, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(218, 41, 28, 0.4);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 2rem;
            color: rgba(255, 255, 255, 0.4);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            transition: 0.3s;
        }

        .back-link:hover {
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-blob blob-1"></div>
    <div class="login-blob blob-2"></div>

    <div class="login-card">
        <div class="logo-section">
            <h1 class="logo-text"><span class="brand-red">Admin</span>Portal</h1>
            <p style="color: rgba(255,255,255,0.4); font-weight: 600; margin-top: 0.5rem;">Ayaka Josei Center Management</p>
        </div>

        <form action="/login" method="POST">
            @csrf
            <input type="hidden" name="role" value="admin">
            
            <div class="input-group">
                <label>Email Address</label>
                <div class="input-wrapper">
                    <i data-lucide="mail"></i>
                    <input type="email" name="email" placeholder="admin@ayakajosei.com" required>
                </div>
            </div>

            <div class="input-group">
                <label>Access Password</label>
                <div class="input-wrapper">
                    <i data-lucide="lock"></i>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">Authorize Access</button>
        </form>

        <a href="/" class="back-link">Return to Main Website</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        lucide.createIcons();

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Opps...',
                text: '{{ $errors->first() }}',
                background: '#0f172a',
                color: '#ffffff',
                confirmButtonColor: '#da291c'
            });
        @endif
    </script>
</body>
</html>
