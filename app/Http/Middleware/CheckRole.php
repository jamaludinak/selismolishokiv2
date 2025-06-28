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
        $userRoleId = $user->role_id;

        // Mapping role names ke role_id
        $roleMapping = [
            'admin' => 1,
            'teknisi' => 2,
            'owner' => 3
        ];

        // Convert role names ke role_id untuk pengecekan
        $requiredRoleIds = [];
        foreach ($roles as $role) {
            if (isset($roleMapping[$role])) {
                $requiredRoleIds[] = $roleMapping[$role];
            }
        }

        if (in_array($userRoleId, $requiredRoleIds)) {
            return $next($request);
        }

        return response()->view('error.403', [], 403);
    }
}
