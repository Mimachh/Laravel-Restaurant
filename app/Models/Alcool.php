<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alcool extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom', 'info_supp', 'prix', 'photo_portrait', 'photo_thumbnail'
    ];

    public function allergenes()
    {
        return $this->belongsToMany(Allergene::class, 'alcool_allergene');
    }

    public function getAllAllergenesNamesAttribute() {
        return $this->allergenes->implode("nom", ', ' );
    }

    public function isOnline() {
        if($this->status == 1) {
            return 'En ligne';
        } else {
            return 'Hors-ligne';
        }
    }
}
