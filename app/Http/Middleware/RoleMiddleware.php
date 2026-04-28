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
        
        // Cek apakah role user ada dalam daftar roles yang diizinkan
        if (!in_array($user->role, $roles)) {
            // Jika bukan role yang sesuai, arahkan ke dashboard masing-masing
            if ($user->role === 'admin') {
                return redirect('/admin');
            } elseif ($user->role === 'penulis') {
                return redirect('/penulis');
            } else {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
