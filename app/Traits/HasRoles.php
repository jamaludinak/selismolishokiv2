<?php

namespace App\Traits;

trait HasRoles
{
    public function hasRole($role): bool
    {
        return $this->role === $role;
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isTeknisi(): bool
    {
        return $this->hasRole('teknisi');
    }

    public function isOwner(): bool
    {
        return $this->hasRole('owner');
    }
} 