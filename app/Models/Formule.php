<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom', 'description', 'prix', 'info_supp'];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_formule');
    }

    public function getAllMenusNamesAttribute() {
        return $this->menus->implode("nom", ', ' );
    }


    public function isOnline() {
        if($this->status == 1) {
            return 'En ligne';
        } else {
            return 'Hors-ligne';
        }
    }

    public function formatPrice() {
        return $this->prix . " €";
    }
}
