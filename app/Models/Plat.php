<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plat extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nom', 'description', 'prix', 'info_supp', 'photo_thumbnail', 'photo_portrait'];


    public function allergenes()
    {
        return $this->belongsToMany(Allergene::class, 'allergene_plat');
    }

    public function getAllAllergenesNamesAttribute() {
        return $this->allergenes->implode("nom", ', ' );
    }
}
