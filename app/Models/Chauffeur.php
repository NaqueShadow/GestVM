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

    public function scopeDispo($query, $pool) {

        return $query->whereIn('idPool', $pool )->where('statut', 1)->get();
    }

    public function scopeDuPool($query, $pool) {

        return $query->whereIn('idPool', $pool )->get();
    }

    public function scopeNbrMiss($query, $pool) {

        return $query->whereIn('idPool', $pool )
            ->with('attributions')
            ->withCount(['attributions'
                => function ($query) {
                    $a = Date::now()->firstOfMonth();
                    $b = Date::now()->lastOfMonth();
                    return $query->whereBetween('attributions.created_at',[$a, $b]);
        }]);
    }

    public function scopeSelectionChauf($query, $tab) {

        return $query->whereDoesntHave('absences', function ($query) use ($tab) {
                $query->whereBetween('debutAbs', $tab)
                    ->orWhereBetween('finAbs', $tab);
            })
            ->where(function ($query) use ($tab) {
                $query->whereDoesntHave('attributions', function ($query) use ($tab) {
                    $query->whereHas('mission', function ($query) use ($tab) {
                        $query->whereBetween('dateDepart', $tab)
                            ->orWhereBetween('dateRetour', $tab);
                    });
                })
                    ->orWhereHas('attributions', function ($query) use ($tab) {
                        $query->whereHas('mission', function ($query) use ($tab) {
                            $query->whereBetween('dateDepart', $tab)
                                ->orWhereBetween('dateRetour', $tab);
                        })->where('statut', 0);
                    });
            });
    }

    public function vehicule()
    {
        return $this->hasOne('App\Models\Vehicule', 'idChauf', 'matricule');
    }

    public function attributions()
    {
        return $this->hasMany('App\Models\Attribution', 'idChauf', 'matricule');
    }

    public function absences()
    {
        return $this->hasMany('App\Models\Absence', 'idChauf', 'matricule');
    }

    public function pool()
    {
        return $this->belongsTo('App\Models\Pool', 'idPool', 'id');
    }
}
