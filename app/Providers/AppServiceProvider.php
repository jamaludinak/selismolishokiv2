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
            return $user->role === $role;
        });

        // Helper function untuk mengecek multiple roles
        Blade::if('anyrole', function ($roles) {
            if (!auth()->check()) {
                return false;
            }
            
            $user = auth()->user();
            $roles = is_array($roles) ? $roles : [$roles];
            
            return in_array($user->role, $roles);
        });
    }
}
