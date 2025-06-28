<?php

namespace App\Traits;

trait HasRoles
{
    public function hasRole($role): bool
    {
        // Mapping role names ke role_id
        $roleMapping = [
            'admin' => 1,
            'teknisi' => 2,
            'owner' => 3
        ];

        $roleId = is_numeric($role) ? $role : ($roleMapping[$role] ?? null);
        return $this->role_id === $roleId;
    }

    public function hasAnyRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    public function isAdmin(): bool
    {
        return $this->role_id === 1;
    }

    public function isTeknisi(): bool
    {
        return $this->role_id === 2;
    }

    public function isOwner(): bool
    {
        return $this->role_id === 3;
    }
} 