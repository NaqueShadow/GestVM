<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $guarded = [];

    //protected $dateFormat = 'd-m-Y H:i:s';

    protected $dates = [
        'debutAbs',
        'finAbs',
    ];

    public function chauffeur()
    {
        return $this->belongsTo('App\Models\Chauffeur', 'idChauf', 'id');
    }
}
