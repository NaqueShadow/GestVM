<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;

    public function vehicules()
    {
        return $this->hasMany('App\Models\Vehicule', 'idPool');
    }
}
