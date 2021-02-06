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

        return $query->where('idPool', auth()->user()->idPool )->get();
    }

    public function scopeDispo ($query) {

        return $query->where('statut', 1 )->get();
    }

    public function scopeNbrMiss($query) {

        return $query->where('idPool', auth()->user()->idPool )
            ->withCount(['attributions'
            => function ($query) {
                    $a = Date::now()->firstOfMonth();
                    $b = Date::now()->lastOfMonth();
                    return $query->whereBetween('attributions.created_at',[$a, $b]);
                }]);
    }

    public function scopeSelection($query) {

        return $query->where('idPool', auth()->user()->idPool )
            ->where(function ($query){
                $query->whereDoesntHave('interventions', function ($query) {
                    $query->whereBetween('debut', session('tab' ))
                        ->orWhereBetween('finPrev', session('tab' ));
                })
                    ->orWhereHas('interventions', function ($query) {
                        $query->whereBetween('debut', session('tab' ))
                            ->orWhereBetween('finPrev', session('tab' ))
                            ->where('statut', 0);
                    });
            })->where(function ($query){
                $query->whereDoesntHave('attributions', function ($query) {
                    $query->whereHas('mission', function ($query) {
                        $query->whereBetween('dateDepart', session('tab' ))
                            ->orWhereBetween('dateRetour', session('tab' ));
                    });
                })
                    ->orWhereHas('attributions', function ($query) {
                        $query->whereHas('mission', function ($query) {
                            $query->whereBetween('dateDepart', session('tab' ))
                                ->orWhereBetween('dateRetour', session('tab' ));
                        })->where('statut', 0);
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
