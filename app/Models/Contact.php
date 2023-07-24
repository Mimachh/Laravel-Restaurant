<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

        /**
     * Les attributs qui sont remplissables massivement.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'email',
        'phone',
        'message',
        'rules',
    ];
}
