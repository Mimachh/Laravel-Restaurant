@props(['route' => "welcome", 'title' => 'Accueil'])

@php
// Vérifie si la route actuelle correspond à la route passée en paramètre
$currentRoute = request()->routeIs($route) ? 'text-gold' : '';
@endphp

<li>
    <a href="#{{ $route }}" 
    class="transition-colors duration-75 ease-linear hover:text-gold  navbar-link 
    font-figtree
    "
    data-section-id="{{ $route }}"
    >
        {{$title}}
    </a>
</li>