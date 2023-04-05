<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dropoff extends Model
{
    protected $fillable = [
        'date', 'name', 'phone', 'country', 'branch', 'tocountry', 'toprovince', 'toname', 'tophone', 'toaddress1', 'toaddress2', 'topostcode', 'tocity', 'driverId', 'vehicleId', 'status', 'picture'
    ];
}
