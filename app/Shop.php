<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'userId', 'branchId', 'shopname', 'companyliscence', 'niche'
    ];
}
