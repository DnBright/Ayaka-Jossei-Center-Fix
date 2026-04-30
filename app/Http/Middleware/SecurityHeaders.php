<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Mencegah clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Mencegah MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Aktifkan XSS filter di browser
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Referrer policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions Policy (disable fitur berbahaya)
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');

        // Remove server information
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        // Strict Transport Security (HTTPS only) - aktifkan jika production HTTPS
        // $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');

        return $response;
    }
}
