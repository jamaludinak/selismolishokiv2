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
        return $this->role === 'admin';
    }

    public function isTeknisi(): bool
    {
        return $this->role === 'teknisi';
    }

    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    public function getRoleDisplayName(): string
    {
        $roleNames = [
            'admin' => 'Administrator',
            'teknisi' => 'Teknisi',
            'owner' => 'Owner'
        ];

        return $roleNames[$this->role] ?? ucfirst($this->role);
    }
} 