<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Reservation;
use App\Models\User;

class ReservationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Gestionnaire de réservation']);
    }

    public function view(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Gestionnaire de réservation']);
    }

    public function update(User $user): bool
    {
        return $user->hasAnyRole(['Super Admin', 'Admin', 'Gestionnaire de réservation']);
    }

}
