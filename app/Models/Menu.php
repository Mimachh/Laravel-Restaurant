<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom', 'description', 'info_supp'];

    public function entrees()
    {
        return $this->belongsToMany(Entree::class, 'menu_entree');
    }

    public function plats()
    {
        return $this->belongsToMany(Plat::class, 'menu_plat');
    }

    public function desserts()
    {
        return $this->belongsToMany(Dessert::class, 'menu_dessert');
    }

    public function vins()
    {
        return $this->belongsToMany(Vin::class, 'menu_vin');
    }

    public function softs()
    {
        return $this->belongsToMany(Soft::class, 'menu_soft');
    }

    public function alcools()
    {
        return $this->belongsToMany(Alcool::class, 'menu_alcool');
    }

    // public function formules()
    // {
    //     return $this->belongsToMany(Formule::class, 'menu_formule');
    // }

    // public function getAllFormulesNamesAttribute() {
    //     return $this->formules->implode("nom", ', ' );
    // }

    public function isOnline() {
        if($this->status == 1) {
            return 'En ligne';
        } else {
            return 'Hors-ligne';
        }
    }

    public function getEntrees() {
        $menu = "";
            if($this->entrees) { 
                foreach($this->entrees as $entree) {
                    $menu .= $entree->nom;
                }
            }

        return $menu;
    }

    public function getPlats() {
        $plats = "";
        if($this->plats) { 
            foreach($this->plats as $plat) {
                $plats .= $plat->nom;
            }
        }

        return $plats;
    }

    public function getDesserts() {
        $desserts = "";
        if($this->desserts) { 
            foreach($this->desserts as $dessert) {
                $desserts .= $dessert->nom;
            }
        }

        return $desserts;
    }

}
