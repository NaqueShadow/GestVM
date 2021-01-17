<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vehicules()
    {
        return $this->hasMany('App\Models\Vehicule', 'idPool');
    }

    public function chauffeurs()
    {
        return $this->hasMany('App\Models\Chauffeur', 'idPool');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'idPool');
    }
}
