<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserAccess
{
    public function handle(Request $request, Closure $next)
    {
        // Contoh: Cek apakah user memiliki role tertentu atau kondisi lainnya
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Jika tidak memenuhi syarat, redirect atau berikan response error
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
