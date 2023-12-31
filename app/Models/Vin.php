<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Vin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom', 
        'description', 
        'prix', 
        'annee', 
        'photo_thumbnail', 
        'photo_portrait'
    ];

    public function isOnline() {
        if($this->status == 1) {
            return 'En ligne';
        } else {
            return 'Hors-ligne';
        }
    }
}
