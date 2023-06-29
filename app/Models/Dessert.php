<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dessert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nom', 'description', 'prix', 'info_supp', 'photo_thumbnail', 'photo_portrait'];

    public function allergenes()
    {
        return $this->belongsToMany(Allergene::class, 'allergene_dessert');
    }

    public function getAllAllergenesNamesAttribute() {
        return $this->allergenes->implode("nom", ', ' );
    }
}
