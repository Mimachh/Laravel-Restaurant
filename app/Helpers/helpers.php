<?php

use Illuminate\Support\Str;

function userName() {
    return auth()->user()->name;
}

function getRolesName() {
    $rolesName = "";

    $i = 0;

    foreach(auth()->user()->roles as $role) {
        $rolesName .= $role->name;

        if($i < sizeof(auth()->user()->roles) -1) {
            $rolesName .= ", ";
        }
        $i ++;
    }

    return $rolesName;
}


// Fonction par exemple pour ouvrir un menu déroulant en fonction de l'url
function setMenuClass($route, $classe) {

    $routeActuelle = request()->route()->getName();

    if(contains($routeActuelle, $route)) {
        return $classe;
    }

    return "";

    // Ensuite il suffit de mettre dans la class du menu correspondant {{ setMenuClass('admin.utilisateurs.', 'menu-open') }} ou encore {{ setMenuClass('admin.utilisateurs.', 'active') }}
}

function setMenuActive($route) {

    $routeActuelle = request()->route()->getName();

    if(contains($routeActuelle, $route)) {
        return 'active';
    }

    return "";

}

function setMenuOpen($routes, $classe) {

    $routeActuelle = request()->route()->getName();

    foreach ($routes as $route) {
        if (str_contains($routeActuelle, $route)) {
            return $classe;
        }
    }

    return "";

    // Ensuite il suffit de mettre dans la class du menu correspondant {{ setMenuClass('admin.utilisateurs.', 'menu-open') }} ou encore {{ setMenuClass('admin.utilisateurs.', 'active') }}
}

// Fonction qui va servir notamment pour le setMenuOpen, à vérifier par exemple que le route name contient un prefix par exemple
function contains($container, $contenu) {
    return Str::contains($container, $contenu);
}


function booleanOptionState($data) {
    if($data == 1) {
        return '<span class="pill-actif">Activé</span>';
    } else {
        return '<span class="pill-inactif">Désactivé</span>';
    };
}