<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'matricule',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['agent'];

    public function getStatutAttribute($attributes) {

        return [
            '0' => 'inactif',
            '1' => 'actif',
        ][$attributes];
    }

    /*
    public function getRoleAttribute($attributes) {

        return [
            '1' => 'missionnaire',
            '2' => 'chef de garage',
            '3' => 'chargé des imputation',
            '4' => 'responsable de pool',
        ][$attributes];
    }
    */

    public function agent()
    {
        return $this->hasOne('App\Models\Agent', 'matricule');
    }

    public function missions()
    {
        return $this->hasMany('App\Models\Mission', 'demandeur');
    }
}
