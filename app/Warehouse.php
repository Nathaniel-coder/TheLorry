<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'name', 'category', 'quantity', 'weight', 'length', 'height', 'width', 'price'
    ];
}
