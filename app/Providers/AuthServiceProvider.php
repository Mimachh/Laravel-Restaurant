<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // SUPER ADMIN
        Gate::define('viewUserInAdmin', function (User $user) {
            return $user->hasRole('Super Admin');
        });

        // CARTE / AUTEUR
        Gate::define('viewMenuInAdmin', function (User $user) {
            return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
        });

        Gate::define('viewPlatInAdmin', function (User $user) {
            return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
        });
        
        Gate::define('viewAllergenesInAdmin', function (User $user) {
            return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
        });
        
        Gate::define('viewFormulesInAdmin', function (User $user) {
            return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
        });

        Gate::define('viewVinsInAdmin', function (User $user) {
            return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
        });

        Gate::define('viewEntreesInAdmin', function (User $user) {
            return $user->hasAnyRole(['Super Admin', 'Admin', 'Auteur']);
        });


        // GESTION RESTAURANT
        Gate::define('viewHorairesInAdmin', function (User $user) {
            // return $user->roles->contains('id', 2) || $user->roles->contains('id', 4);
            return $user->hasAnyRole(['Super Admin', 'Admin', 'Gestionnaire de réservation']);
        });

        Gate::define('viewTablesCouvertsInAdmin', function (User $user) {
            // return $user->roles->contains('id', 2) || $user->roles->contains('id', 4);
            return $user->hasAnyRole(['Super Admin', 'Admin', 'Gestionnaire de réservation']);
        });

        Gate::define('viewReservationsInAdmin', function (User $user) {
            // return $user->roles->contains('id', 2) || $user->roles->contains('id', 4);
            return $user->hasAnyRole(['Super Admin', 'Admin', 'Gestionnaire de réservation']);
        });

    }
}
