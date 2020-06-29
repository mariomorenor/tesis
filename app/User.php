<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
<<<<<<< HEAD
        'password', 'remember_token',
=======
         'remember_token',
>>>>>>> ab9cc6bd0a625ad6f648e297d41c497e9b1ec103
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
       
    ];

<<<<<<< HEAD
    // protected $with = ['Roles_u'];
    
    // public function Roles_u() //Tiene ese nombre porque da problemas con Spatie al usar la funcion assignRole en un usuario
    // {
    //     return $this->belongsToMany(Role::class,'user_has_roles');
    // }
=======
    protected $with = ['Roles_u'];
    
    public function Roles_u() //Tiene ese nombre porque da problemas con Spatie al usar la funcion assignRole en un usuario
    {
        return $this->belongsToMany(Role::class,'user_has_roles');
    }
>>>>>>> ab9cc6bd0a625ad6f648e297d41c497e9b1ec103
}
