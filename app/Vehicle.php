<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'platno', 'brand', 'model', 'category', 'year', 'situated', 'availability'
    ];
}
