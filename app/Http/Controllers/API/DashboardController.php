<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Pickup;
use App\Dropoff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Warehouse;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // User Count
        $user = User::where('type', 'Customer')->count();

        $dropOff = Dropoff::all()->pluck('price')->toArray();
        $pickUp = Pickup::all()->pluck('price')->toArray();
        $total = array_sum($dropOff) + array_sum($pickUp);

        //Bounce Rates
        $lastDrop = Dropoff::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $lastPick = Dropoff::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $thisDrop = Dropoff::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        $thisPick = Pickup::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();

        $lastMonth = $lastDrop + $lastPick;
        $thisMonth = $thisDrop + $thisPick;
        if ($lastMonth != 0 && $thisMonth != 0) {
            $bounceRate = (($lastMonth / $thisMonth) * 100) - 100;
        } else {
            $bounceRate = 0;
        }

        //todays sales
        $dropOff = Dropoff::where('created_at', today())->pluck('price')->toArray();
        $pickUp = Pickup::where('created_at', today())->pluck('price')->toArray();
        $todayOrder = array_sum($dropOff) + array_sum($pickUp);

        $warehouse = Warehouse::all()->pluck('quantity')->toArray();
        $warehousetotal = array_sum($warehouse);

        $data = [$user, $todayOrder, $bounceRate, $warehousetotal, $total];
        return $data;
    }

    public function DropCount()
    {
        return Dropoff::count();
    }

    public function PickCount()
    {
        return Pickup::count();
    }

    public function chart()
    {
        $drop = Dropoff::all();
        $pick = Pickup::all();

        $chartData = [
            [
                'label' => 'Drop Off',
                'value' => $drop->count(),
            ],
            [
                'label' => 'Pick Up',
                'value' => $pick->count(),
            ]
        ];
        return response()->json($chartData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
