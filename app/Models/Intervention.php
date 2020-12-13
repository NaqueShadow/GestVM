<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeEnCours ($query) {

        return $query->where('etat', 1)->get();
    }
}
