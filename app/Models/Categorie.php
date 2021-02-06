<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    public $primaryKey = 'categ';
    public $incrementing = false;
    protected $guarded = [];
}
