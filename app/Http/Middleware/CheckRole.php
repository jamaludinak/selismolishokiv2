<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        // Cek apakah role user ada dalam daftar role yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        return response()->view('error.403', [], 403);
    }
}
