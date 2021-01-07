<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocBord extends Model
{
    use HasFactory;

    protected $dates = [
        'etabl',
        'exp',
    ];

    public function vehicule()
    {
        return $this->belongsTo('App\Models\Vehicule', 'idVehicule');
    }
}
