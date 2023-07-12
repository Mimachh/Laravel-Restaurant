<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->

    <!-- TIMEPICKER -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
                    @can('viewCarteInAdmin')
                    <li><span 
                    class="menu-button-carte
                    {{ 
                        setMenuOpen([
                            'admin.entrees.',
                            'admin.plats.',
                            'admin.desserts.',
                            'admin.menus.',
                            'admin.formules.',
                            'admin.allergenes.',
                            'admin.vins.',
                            'admin.alcools.',
                            'admin.softs.'
                        ], 'open-links-div-carte') 
                    }}
                    "
                    onclick="toggleMenuLinksCarte()"
                    ><span>Carte</span>
                    <span class="toggleSpanPlusCarte">+</span>
                    <span class="toggleSpanMinusCarte">-</span>
                    </span>
                    
                    </li>
                    @endcan

                    <div class="menu-links-container" id="menuLinksContainerCarte">
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

                        @can('viewAlcoolsInAdmin')
                        <li><a href="{{ route('admin.alcools.index') }}"
                        class="{{ setMenuActive('admin.alcools.') }}"
                        >Boissons alcoolisées</a></li>
                        @endcan

                        @can('viewSoftsInAdmin')
                        <li><a href="{{ route('admin.softs.index') }}"
                        class="{{ setMenuActive('admin.softs.') }}"
                        >Boissons non-alcoolisées</a></li>
                        @endcan
                        <br>
                    </div>

                    @can('viewRestoInAdmin')
                    <li><span 
                    class="menu-button-resto
                    {{ 
                        setMenuOpen([
                            'admin.creneaux.',
                            'admin.options_reservation.',
                        ], 'open-links-div-resto') 
                    }}
                    "
                    onclick="toggleMenuLinksResto()"
                    ><span>Restaurant</span>
                    <span class="toggleSpanPlusResto">+</span>
                    <span class="toggleSpanMinusResto">-</span>
                    </span>  
                    </li>
                    @endcan
                    <div id="menuLinksContainerResto" class="menu-links-container-resto">
                        @can('viewHorairesInAdmin')
                        <li><a href="{{ route('admin.creneaux.index') }}"
                        class="{{ setMenuClass('admin.creneaux.', 'active') }}"
                        >Créneaux</a></li>
                        @endcan

                        @can('viewOptionsReservationsInAdmin')
                        <li><a href="{{ route('admin.options_reservation.index') }}"
                        class="{{ setMenuClass('admin.options_reservation.', 'active') }}"
                        >Options de réservation</a></li>
                        @endcan
                    </div>

                    @can('viewReservationsInAdmin')
                        <li><span 
                        class="menu-button-resa
                        {{ 
                            setMenuOpen([
                                'admin.reservations.',
                                'admin.historique.',
                                'admin.options_reservation.',
                                'admin.attente.',
                            ], 'open-links-div-resa') 
                        }}
                        "
                        onclick="toggleMenuLinksResa()"
                        ><span>Réservations</span>
                        <span class="toggleSpanPlusResa">+</span>
                        <span class="toggleSpanMinusResa">-</span>
                        </span>
                        </li>
                        
                        <div id="menuLinksContainerResa" class="menu-links-container-resa">
                            @can('viewHandleReservationsInAdmin')
                            <li><a href="{{ route('admin.attente.index') }}"
                            class="{{ setMenuClass('admin.attente.', 'active') }}"
                            >Réservations en attente</a></li>
                            @endcan

                            @can('viewHandleReservationsInAdmin')
                            <li><a href="{{ route('admin.reservations.index') }}"
                            class="{{ setMenuClass('admin.reservations.', 'active') }}"
                            >Réservations validées</a></li>
                            @endcan

                            @can('viewHandleReservationsInAdmin')
                            <li><a href="{{ route('admin.historique.index') }}"
                            class="{{ setMenuClass('admin.historique.', 'active') }}"
                            >Réservations passées</a></li>
                            @endcan
                        </div>

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
    
    <script src="{{ asset('js/admin/toggleMenuLink.js') }}"></script>
    @yield('scripts')

    @push('scripts')
        <script>
            // Votre code JavaScript ici
        </script>
    @endpush
</body>
</html>
