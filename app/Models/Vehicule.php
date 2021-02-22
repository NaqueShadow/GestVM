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

    protected $dates = [
        'dernierRetour',
        'acquisition',
    ];


    public function getStatutAttribute($attributes) {

        return [
            '0' => 'En maintenance',
            '1' => 'Disponible',
            '2' => 'En mission',
        ][$attributes];
    }


    public function scopeDuPool ($query) {

        return $query->whereIn('idPool', auth()->user()->pools )->get();
    }

    public function scopeDispo ($query) {

        return $query->where('statut', 1 )->get();
    }

    public function scopeNbrMiss($query, $rp) {

        return $query->whereIn('idPool', $rp )
            ->withCount(['attributions'
            => function ($query) {
                    $a = Date::now()->firstOfMonth();
                    $b = Date::now()->lastOfMonth();
                    return $query->whereBetween('attributions.created_at',[$a, $b]);
                }]);
    }

    public function scopeSelection($query, $tab) {

        return $query->where(function ($query) use ($tab){
                $query->whereDoesntHave('interventions', function ($query) use ($tab) {
                    $query->whereBetween('debut', $tab)
                        ->orWhereBetween('finPrev', $tab);
                })
                    ->orWhereHas('interventions', function ($query) use ($tab) {
                        $query->where('statut', 0)
                         ->where(function ($query) use ($tab) {
                             $query->whereBetween('debut', $tab)
                                ->orWhereBetween('finPrev', $tab);
                         });
                    });
            })->where(function ($query) use ($tab) {
                $query->whereDoesntHave('attributions', function ($query) use ($tab) {
                    $query->whereHas('mission', function ($query) use ($tab) {
                        $query->whereBetween('dateDepart', $tab)
                            ->orWhereBetween('dateRetour', $tab);
                    });
                })
                    ->orWhereHas('attributions', function ($query) use ($tab) {
                        $query->where('statut', 0)
                        ->whereHas('mission', function ($query) use ($tab) {
                            $query->whereBetween('dateDepart', $tab)
                            ->orWhereBetween('dateRetour', $tab);
                        });
                    });
            });
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

    public function docBord()
    {
        return $this->hasMany('App\Models\DocBord', 'idVehicule', 'code');
    }
}
