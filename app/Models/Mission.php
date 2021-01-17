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

    /*public function scopeDemandeur($query)
    {
        return $query->where('status', 1);
    }*/

    public function scopeDuPool ($query) {

        return $query->where('dmdeur.idPool', auth()->user()->idPool )->get();
    }

    public function scopeNew($query) {

        return $query->doesntHave('attributions')
            ->whereHas('dmdeur', function ($query) {
                $query->where('idPool', auth()->user()->idPool );
            })
            ->where('dateRetour', '>', today())
            ->orWhere('dateRetour', '=', today())
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

}
