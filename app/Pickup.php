<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    protected $fillable = [
        'date', 'name', 'phone', 'country', 'address1', 'address2', 'postcode' , 'city' , 'province' , 'tocountry', 'toprovince', 'toname', 'tophone', 'toaddress1', 'toaddress2', 'topostcode', 'tocity', 'driverId', 'vehicleId', 'status', 'picture'
    ];
}
