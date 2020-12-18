<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Vehicule extends Model
{
    use HasFactory;

    public $primaryKey = 'code';
    protected $guarded = [];
    public $incrementing = false;


    public function getStatutAttribute($attributes) {

        return [
            '0' => 'En maintenance',
            '1' => 'Disponible',
            '2' => 'En mission',
        ][$attributes];
    }


    public function scopeDuPool ($query) {

        return $query->where('idPool', auth()->user()->idPool )->get();
    }

    public function scopeDispo ($query) {

        return $query->where('statut', 1 )->get();
    }

    public function scopeNbrMiss($query) {

        return $query->where('idPool', auth()->user()->idPool )
            ->with('attributions')
            ->withCount(['attributions'
            => function ($query) {
                    $a = Date::now()->firstOfMonth();
                    $b = Date::now()->lastOfMonth();
                    return $query->whereBetween('attributions.created_at',[$a, $b]);
                }])->get();
    }

    public function scopeSelection($query, $tab) {
        $tab1 = $tab;
        return $query->where('idPool', auth()->user()->idPool )
            ->whereDoesntHave('interventions', function ($query, $tab1) {
                $query->whereBeetween('debut', $tab1)
                    ->whereBeetween('finPrev', $tab1);
            })
            ->whereDoesntHave('attribution', function ($query, $tab) {
                $query->with('mission')
                    ->whereBeetween('dateDepart', $tab)
                    ->whereBeetween('dateRetour', $tab);
            })
            ->get();
    }


    public function interventions()
    {
        return $this->hasMany('App\Models\Intervention', 'idVehicule', 'code');
    }

    public function chauffeur()
    {
        return $this->belongsTo('App\Models\Chauffeur', 'idChauf', 'matricule');
    }


    public function pool()
    {
        return $this->belongsTo('App\Models\Pool', 'idPool', 'id');
    }

    public function attributions()
    {
        return $this->hasMany('App\Models\Attribution', 'idVehicule', 'code');
    }
}
