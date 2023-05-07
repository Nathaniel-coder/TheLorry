<?php

use App\Branch;
use App\User;
use App\Dropoff;
use App\Vehicle;
use Carbon\Carbon;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DropOffSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            $user = User::where('type', 'Customer')->inRandomOrder()->first();
            $driver = User::where('type', 'Driver')->inRandomOrder()->first();
            $branch = Branch::inRandomOrder()->first();
            $vehicle = Vehicle::inRandomOrder()->first();
            DropOff::create([
                'name' => $driver->name,
                'date' => today(),
                'phone' => $driver->phone,
                // 'branch' => 'Branch ' . $i,
                'branch' => 'Branch ' . $i,
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
                'status' => 'Delivered',
            ]);
        }
    }
}

