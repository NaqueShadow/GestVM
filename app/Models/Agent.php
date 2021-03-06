<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    public $primaryKey = 'matricule';
    public $incrementing = false;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'matricule', 'matricule');
    }

    public function missions()
    {
        return $this->belongsToMany('App\Models\Mission', 'missionnaires', 'agentId', 'missionId', 'matricule', 'id');
    }

    public function entite()
    {
        return $this->belongsTo('App\Models\Entite', 'idEntite', 'id');
    }
}
