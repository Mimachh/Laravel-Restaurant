<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Role;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    protected static function boot()
    {
        parent::boot();
    
        self::created(function ($user) {
            $user->roles()->attach(5);
        });
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function hasRole($role) {
        return $this->roles()->where('name', $role)->first() !== null;
    }

    public function hasAnyRole($roles) {
        return $this->roles()->whereIn('name', $roles)->first() !== null;
    }


    // Utiliser comme nouveau champs dans l'index des users par exemple, il faut utiliser pascalCase, get et Attribute
    public function getAllRoleNamesAttribute() {
        return $this->roles->implode("name", ', ' );
    }

}
