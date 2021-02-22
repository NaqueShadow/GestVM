<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;
    public $primaryKey = 'code';
    protected $guarded = [];
    public $incrementing = false;

    public function missions()
    {
        return $this->hasMany('App\Models\Mission', 'idActivite');
    }
}
