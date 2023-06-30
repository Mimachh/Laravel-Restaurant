<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allergene extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
    ];

    // public function plats()
    // {
    //     return $this->belongsToMany(Plat::class, 'allergene_plat');
    // }

}
