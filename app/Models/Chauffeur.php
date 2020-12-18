<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Chauffeur extends Model
{
    use HasFactory;

    public $primaryKey = 'matricule';
    protected $guarded = [];
    public $incrementing = false;

    public function getStatutAttribute($attributes) {

        return [
            '0' => 'Indisponible',
            '1' => 'Disponible',
        ][$attributes];
    }

    public function scopeDispo($query) {

        return $query->where('idPool', auth()->user()->idPool )->where('statut', 1)->get();
    }

    public function scopeDuPool($query) {

        return $query->where('idPool', auth()->user()->idPool )->get();
    }

    public function scopeNbrMiss($query) {

        return $query->where('idPool', auth()->user()->idPool )
            ->with('attributions')
            ->withCount(['attributions'
                => function ($query) {
                    $a = Date::now()->firstOfMonth();
                    $b = Date::now()->lastOfMonth();
                    return $query->whereBetween('attributions.created_at',[$a, $b]);
        }])->get();;
    }

    public function vehicule()
    {
        return $this->hasOne('App\Models\Vehicule', 'idChauf', 'matricule');
    }

    public function attributions()
    {
        return $this->hasMany('App\Models\Attribution', 'idChauf', 'matricule');
    }
}
