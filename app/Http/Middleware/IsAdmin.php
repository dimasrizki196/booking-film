<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Silakan masuk
        }

        // Jika bukan admin, lempar balik ke dashboard biasa (bisa juga pakai abort(403); untuk error forbidden)
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki izin mengakses halaman Admin.');
    }
}
