<?php

use App\Pickup;
use App\User;
use App\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class PickUpSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            $user = User::where('type', 'Customer')->inRandomOrder()->first();
            $driver = User::where('type', 'Driver')->inRandomOrder()->first();
            $vehicle = Vehicle::inRandomOrder()->first();
            PickUp::create([
                'name' => $driver->name,
                'date' => today(),
                'phone' => $driver->phone,
                // 'branch' => 'Branch ' . $i,
                'address1' => $driver->address1,
                'address2' => $driver->address2,
                'postcode' => $driver->postcode,
                'city' => $driver->city,
                'province' => $driver->province,
                'country' => $driver->province,
                'toaddress1' => $user->address1,
                'toaddress2' => $user->address2,
                'topostcode' => $user->postcode,
                'tocity' => $user->city,
                'toprovince' => $user->province,
                'tocountry' => $user->country,
                'driverId' => $driver->name,
                'vehicleId' => $vehicle->platno,
                'status' => 'completed',
                'toname' => $user->name,
                'tophone' => $user->phone,
                'weight' => random_int(1, 99),
                'height' => random_int(1, 99),
                'length' => random_int(1, 99),
                'width' => random_int(1, 99),
                'price' => random_int(1, 99),
                'country' => $user->country,
                'status' => 'Delivered'
            ]);
        }
    }
}

