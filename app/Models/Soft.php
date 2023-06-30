<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Soft extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom', 'info_supp', 'prix', 'photo_portrait', 'photo_thumbnail'
    ];

    public function allergenes()
    {
        return $this->belongsToMany(Allergene::class, 'allergene_soft');
    }

    public function getAllAllergenesNamesAttribute() {
        return $this->allergenes->implode("nom", ', ' );
    }
}
