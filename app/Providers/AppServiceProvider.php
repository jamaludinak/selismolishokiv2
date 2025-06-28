<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Helper function untuk mengecek role
        Blade::if('role', function ($role) {
            if (!auth()->check()) {
                return false;
            }
            
            $user = auth()->user();
            $roleMapping = [
                'admin' => 1,
                'teknisi' => 2,
                'owner' => 3
            ];
            
            $roleId = is_numeric($role) ? $role : ($roleMapping[$role] ?? null);
            return $user->role_id === $roleId;
        });

        // Helper function untuk mengecek multiple roles
        Blade::if('anyrole', function ($roles) {
            if (!auth()->check()) {
                return false;
            }
            
            $user = auth()->user();
            $roleMapping = [
                'admin' => 1,
                'teknisi' => 2,
                'owner' => 3
            ];
            
            $roles = is_array($roles) ? $roles : [$roles];
            
            foreach ($roles as $role) {
                $roleId = is_numeric($role) ? $role : ($roleMapping[$role] ?? null);
                if ($user->role_id === $roleId) {
                    return true;
                }
            }
            
            return false;
        });
    }
}
