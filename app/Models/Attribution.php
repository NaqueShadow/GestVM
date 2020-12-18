<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribution extends Model
{
    use HasFactory;

    public function scopeEnCours ($query) {

        return $query->where('statut', 1)
            ->with('vehicule', 'chauffeur')
            ->where('vehicule.idPool', auth()->user()->idPool);
    }

    public function vehicule()
    {
        return $this->belongsTo('App\Models\Vehicule', 'idvehicule', 'id');
    }

    public function chauffeur()
    {
        return $this->belongsTo('App\Models\Vehicule', 'idChauf', 'id');
    }

    public function mission()
    {
        return $this->belongsTo('App\Models\Mission', 'idMission', 'id');
    }
}
