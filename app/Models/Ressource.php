<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function attributions()
    {
        return $this->belongsTo('App\Models\Attribution', 'idAttr');
    }
}
