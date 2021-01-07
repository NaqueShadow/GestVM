<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'debut',
        'finPrev',
    ];

    public function scopeEnCours ($query) {

        return $query->where('statut', 1);
    }

    public function vehicule()
    {
        return $this->belongsTo('App\Models\Vehicule', 'idVehicule', 'code');
    }

    public function chauffeur()
    {
        return $this->belongsTo('App\Models\Vehicule', 'matricule', 'code');
    }
}
