<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    @yield('styles')
</head>
<body>
    <section>
        <div class="admin-panel">
            <div class="sidebar">
                <!-- Barre latérale -->
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}"
                    class="{{ setMenuActive('admin.dashboard') }}"
                    >Accueil</a></li>
                    @can('viewUserInAdmin')
                    <li><a href="{{ route('admin.users.index') }}"
                    class="{{ setMenuClass('admin.users.', 'active') }}"
                    >Utilisateurs</a></li>
                    @endcan

                    <br>

                    @can('viewEntreesInAdmin')
                    <li><a href="{{ route('admin.entrees.index') }}"
                    class="{{ setMenuActive('admin.entrees.') }}"
                    >Entrées</a></li>
                    @endcan

                    @can('viewPlatInAdmin')
                    <li><a href="{{ route('admin.plats.index') }}"
                    class="{{ setMenuActive('admin.plats.') }}"
                    >Plats</a></li>
                    @endcan

                    @can('viewDessertsInAdmin')
                    <li><a href="{{ route('admin.desserts.index') }}"
                    class="{{ setMenuActive('admin.desserts.') }}"
                    >Desserts</a></li>
                    @endcan

                    @can('viewMenuInAdmin')
                    <li><a href="{{ route('admin.menus.index') }}"
                    class="{{ setMenuActive('admin.menus.') }}"
                    >Menus</a></li>
                    @endcan

                    @can('viewFormulesInAdmin')
                    <li><a href="{{ route('admin.formules.index') }}"
                    class="{{ setMenuActive('admin.formules.') }}"
                    >Formules</a></li>
                    @endcan

                    @can('viewAllergenesInAdmin')
                    <li><a href="{{ route('admin.allergenes.index') }}"
                    class="{{ setMenuActive('admin.allergenes.') }}"
                    >Allergènes</a></li>
                    @endcan

                    @can('viewVinsInAdmin')
                    <li><a href="{{ route('admin.vins.index') }}"
                    class="{{ setMenuActive('admin.vins.') }}"
                    >Vins</a></li>
                    @endcan

                    <br>
                    @can('viewHorairesInAdmin')
                    <li><a href="">Horaires</a></li>
                    @endcan

                    @can('viewTablesCouvertsInAdmin')
                    <li><a href="">Tables/Couverts</a></li>
                    @endcan

                    @can('viewReservationsInAdmin')
                    <li><a href="">Réservations</a></li>
                    @endcan

                    <hr style="width: 70%;">

                    <li><a href="">Mon Profil</a></li>

                    <li><a href="{{ route('welcome') }}">Retourner sur le site</a></li>
                    <!-- Ajoutez d'autres onglets de navigation ici -->
                </ul>
            </div>
            <div class="admin-content">
                <!-- Display success message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Display error message -->
                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Contenu principal -->
                @yield('content')
            </div>
        </div>
    </section>

    @vite('resources/js/admin/dashboard.js')
    @yield('scripts')

    @push('scripts')
        <script>
            // Votre code JavaScript ici
        </script>
    @endpush
</body>
</html>
