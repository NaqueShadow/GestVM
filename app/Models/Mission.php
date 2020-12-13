<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $guarded = [];

    /*public function scopeDemandeur($query)
    {
        return $query->where('status', 1);
    }*/

    public function demandeur()
    {
        return $this->belongsTo('App\Models\User');
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

}
