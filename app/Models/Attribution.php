<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribution extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['vehicule', 'chauffeur'];

    public function scopeEnCours ($query) {
        foreach (auth()->user()->pools as $p)
            $pl[] = $p->id;

        return $query->where('statut', 1)
            ->whereHas('vehicule', function ($query) use($pl) {
                $query->whereIn('idPool', $pl);
            })
            ->get();
    }

    public function scopeNew($query) {

        foreach (auth()->user()->pools as $p)
            $pl[] = $p->id;

        return $query->where('statut', '1')
            ->whereHas('vehicule', function ($query) use($pl) {
                $query->whereIn('idPool', $pl);
            })->count();
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

    public function ressource()
    {
        return $this->hasOne('App\Models\Ressource', 'idAttr');
    }

}
