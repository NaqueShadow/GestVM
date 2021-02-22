<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Mission extends Model
{
    use HasFactory;

    protected $guarded = [];

    //protected $dateFormat = 'd-m-Y H:i:s';

    protected $dates = [
        'dateDepart',
        'dateRetour',
    ];

    protected $with = ['villeDesti', 'dmdeur',];

    public function getValidationAttribute($attributes) {

        return [
            '2' => 'Invalidée',
            '0' => 'Aucun avis',
            '1' => 'Validée',
        ][$attributes];
    }

    public function scopeDuPool ($query) {

        return $query->where('dmdeur.idPool', auth()->user()->idPool )->get();
    }

    public function scopeNew($query) {

        foreach (auth()->user()->pools as $p)
            $pl[] = $p->id;

        return $query->doesntHave('attributions')
            ->where('validation', '1')
            ->whereHas('pool', function ($query) use($pl) {
                $query->whereIn('id', $pl );
            })->where(function ($query){
                $query->where('dateRetour', '>', today())
                    ->orWhere('dateRetour', '=', today());
            })->count();
    }

    public function scopeNewV($query) {

        return $query->doesntHave('attributions')
            ->where('validation', '0')
            ->whereHas('dmdeur', function ($query) {
                $query->where('idPool', auth()->user()->idPool );
            })->where('idValideur', auth()->user()->id )
            ->count();
    }

    public function dmdeur()
    {
        return $this->belongsTo('App\Models\User', 'demandeur');
    }

    public function agents()
    {
        return $this->belongsToMany('App\Models\Agent', 'missionnaires', 'missionId', 'agentId', 'id', 'matricule');
    }


    public function villeDesti()
    {
        return $this->belongsTo('App\Models\Ville', 'villeDest', 'id');
    }

    public function villeDep()
    {
        return $this->belongsTo('App\Models\Ville', 'villeDepart', 'id');
    }

    public function attributions()
    {
        return $this->hasMany('App\Models\Attribution', 'idMission');
    }

    public function valideur()
    {
        return $this->belongsTo('App\Models\User', 'idValideur', 'id');
    }

    public function chauffeur()
    {
        return $this->belongsTo('App\Models\Chauffeur', 'idChauf', 'matricule');
    }

    public function entite()
    {
        return $this->belongsTo('App\Models\Entite', 'idEntite');
    }

    public function activite()
    {
        return $this->belongsTo('App\Models\Activite', 'idActivite');
    }

    public function pool()
    {
        return $this->belongsTo('App\Models\Pool', 'idPool');
    }

}
