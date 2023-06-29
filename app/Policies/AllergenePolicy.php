<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Allergene;
use App\Models\User;

class AllergenePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Allergene $allergene): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function softDelete(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

    public function viewInTrash(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
    }
}
