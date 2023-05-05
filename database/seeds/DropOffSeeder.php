<?php

use App\Dropoff;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DropOffSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            DropOff::create([
                'name' => 'DropOff ' . $i,
                'date' => '2023/2/1',
                'phone' => '1234567890',
                'branch' => 'Branch ' . $i,
                'toaddress1' => 'Address 1',
                'toaddress2' => 'Address 2',
                'topostcode' => '12345',
                'tocity' => 'City',
                'toprovince' => 'Province',
                'tocountry' => 'Country',
                'driverId' => $i,
                'vehicleId' => $i,
                'status' => 'completed',
                'toname' => $i,
                'tophone' => '012345678',
                'weight' => $i,
                'height' => $i,
                'length' => $i,
                'width' => $i,
                'price' => 10.00 * $i,
                'country' => $i,
                'status' => 'Delivered'
            ]);
        }
    }
}

