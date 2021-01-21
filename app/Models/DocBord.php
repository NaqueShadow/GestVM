<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocBord extends Model
{
    use HasFactory;

    public $primaryKey = 'numero';
    public $incrementing = false;
    protected $guarded = [];

    protected $dates = [
        'etabl',
        'exp',
    ];

    public function getTypeAttribute($attributes) {

        return [
            '1' => 'Assurance',
            '2' => 'Visite technique',
            '3' => 'Carte grise',
        ][$attributes];
    }

    public function vehicule()
    {
        return $this->belongsTo('App\Models\Vehicule', 'idVehicule');
    }
}
