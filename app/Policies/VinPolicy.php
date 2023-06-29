<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Vin;
use App\Models\User;

class VinPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

    public function update(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

 
    public function softDelete(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

 
    public function restore(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

    public function forceDelete(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

    public function viewInTrash(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }
}
