<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuruMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->isGuru() || auth()->user()->isAdmin())) {
            return $next($request);
        }

        abort(403, 'Akses Ditolak. Hanya Guru dan Admin yang boleh mengakses halaman ini.');
    }
}