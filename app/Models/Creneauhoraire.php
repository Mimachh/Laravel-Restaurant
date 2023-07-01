<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creneauhoraire extends Model
{
    use HasFactory;

    public function jours()
    {
        return $this->belongsToMany(Jour::class, 'jour_creneauhoraire');
    }
}
