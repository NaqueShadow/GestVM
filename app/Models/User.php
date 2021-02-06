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
        'login',
        'password',
        'role',
        'statut',
        'idPool',
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

    public function agent()
    {
        return $this->hasOne('App\Models\Agent', 'matricule', 'matricule');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'roles_users', 'idUser', 'idRole');
    }

    public function missions()
    {
        return $this->hasMany('App\Models\Mission', 'demandeur');
    }

    public function validations()
    {
        return $this->hasMany('App\Models\Mission', 'idValideur');
    }

    public function pool()
    {
        return $this->belongsTo('App\Models\Pool', 'idPool', 'id');
    }

    public function validation()
    {
        return $this->hasMany('App\Models\Validation', 'idMission');
    }
}
