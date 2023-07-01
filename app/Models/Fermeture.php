<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fermeture extends Model
{
    use HasFactory;

    protected $fillable = ['date_debut', 'date_fin', 'raison', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];
}
