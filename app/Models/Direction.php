<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function entites()
    {
        return $this->hasMany('App\Models\Entite', 'idDirection');
    }
}
