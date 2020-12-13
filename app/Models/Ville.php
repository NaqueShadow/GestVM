<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;


    public function missions()
    {
        return $this->hasMany('App\Models\Mission','villeDest');
    }
}
