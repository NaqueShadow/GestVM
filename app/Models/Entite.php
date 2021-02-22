<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entite extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function attributions()
    {
        return $this->hasMany('App\Models\Attribution', 'idEntite');
    }

    public function pools()
    {
        return $this->belongsToMany('App\Models\Pool', 'entites_pools', 'idEntite', 'idPool');
    }

    public function direction()
    {
        return $this->belongsTo('App\Models\Direction', 'idDirection', 'id');
    }

    public function agents()
    {
        return $this->hasMany('App\Models\Agent', 'idEntite', 'id');
    }

    public function missions()
    {
        return $this->hasMany('App\Models\Mission', 'idEntite');
    }
}
