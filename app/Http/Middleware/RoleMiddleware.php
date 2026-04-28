<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        // Cek apakah akun sudah disetujui (khusus member/user biasa)
        if ($user->role === 'user' && !$user->is_approved) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Akun Anda sedang menunggu persetujuan Admin.']);
        }

        // Cek apakah role user ada dalam daftar roles yang diizinkan
        if (!in_array($user->role, $roles)) {
            // PENGALIHAN TEGAS: Kembalikan ke dashboard masing-masing
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'penulis') {
                return redirect()->route('penulis.dashboard');
            } else {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
