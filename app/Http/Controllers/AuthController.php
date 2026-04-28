<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function showPenulisLogin()
    {
        return view('auth.penulis-login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function showPending()
    {
        return view('auth.pending');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'user',
            'is_approved' => false,
        ]);

        return redirect()->route('pending-approval');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentukan guard berdasarkan role di form
        $role = $request->role ?? 'user';
        $guard = ($role === 'admin' || $role === 'penulis') ? $role : 'web';

        if (Auth::guard($guard)->attempt($credentials)) {
            $user = Auth::guard($guard)->user();

            // CEK VALIDASI PINTU: Role harus cocok dengan Form Login
            if ($user->role !== $role) {
                Auth::guard($guard)->logout();
                return back()->withErrors([
                    'email' => 'Akun Anda tidak terdaftar sebagai ' . ucfirst($role) . '.',
                ])->onlyInput('email');
            }

            if (!$user->is_approved && $user->role !== 'admin' && $user->role !== 'penulis') {
                Auth::guard($guard)->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('pending-approval')->with('status', 'Akun Anda sedang dalam proses validasi oleh admin.');
            }

            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'penulis') {
                return redirect()->route('penulis.dashboard');
            } else {
                return redirect('/');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Logout dari semua guard yang mungkin aktif
        Auth::guard('admin')->logout();
        Auth::guard('penulis')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
