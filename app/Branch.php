<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'branch', 'type', 'address1', 'address2', 'postcode', 'city', 'province', 'country'
    ];
}
