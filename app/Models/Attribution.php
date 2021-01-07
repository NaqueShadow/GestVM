<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribution extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['mission', 'vehicule', 'chauffeur'];

    public function scopeEnCours ($query) {
        return $query->where('statut', 1)
            ->whereHas('vehicule', function ($query) {
                $query->where('idPool', auth()->user()->idPool );
            })
            ->get();
    }

    public function vehicule()
    {
        return $this->belongsTo('App\Models\Vehicule', 'idVehicule');
    }

    public function chauffeur()
    {
        return $this->belongsTo('App\Models\Chauffeur', 'idChauf');
    }

    public function mission()
    {
        return $this->belongsTo('App\Models\Mission', 'idMission');
    }

    public function entite()
    {
        return $this->belongsTo('App\Models\Entite', 'idEntite');
    }

    public function ressourve()
    {
        return $this->belongsTo('App\Models\Ressource', 'idRessource');
    }
}
