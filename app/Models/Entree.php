<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entree extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom', 'description', 'prix', 'info_supp', 'photo_thumbnail', 'photo_portrait', 'status'];

    public function allergenes()
    {
        return $this->belongsToMany(Allergene::class, 'allergene_entree');
    }

    public function getAllAllergenesNamesAttribute() {
        return $this->allergenes->implode("nom", ', ' );
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
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

    public function getImageAttribute() {
        return asset('storage/entrees/portraits/'.$this->photo_portrait);
    }
}
