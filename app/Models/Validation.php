<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getStatutAvis($attributes) {

        return [
            '0' => 'Invalidée',
            '1' => 'Validée',
        ][$attributes];
    }

    public function valideur()
    {
        return $this->belongsTo('App\Models\User', 'idValideur', 'id');
    }
}
