<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Jika belum login, arahkan ke halaman login
            return redirect('/login')->with('error', 'You must be logged in to access this page.');
        }

        // Lanjutkan permintaan jika pengguna adalah admin
        return $next($request);
    }
}

