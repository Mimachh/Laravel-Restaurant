<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['name'];

    public const IS_SUPER_ADMIN = 1;
    public const IS_ADMIN = 2;
    public const IS_AUTHOR = 3;
    public const IS_RESERVATOR = 4;
    public const IS_USER = 5;


    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

}
