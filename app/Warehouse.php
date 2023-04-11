<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'user', 'name', 'category', 'quantity', 'weight', 'length', 'height', 'width', 'price'
    ];
}
