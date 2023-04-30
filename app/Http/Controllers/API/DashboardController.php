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
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // User Count
        $user = User::where('type', 'Customer')->count();

        $dropOff = Dropoff::pluck('price')->toArray();
        $pickUp = Pickup::pluck('price')->toArray();
        $total = array_sum($dropOff) + array_sum($pickUp);

        //Bounce Rates
        // $lastDrop = Dropoff::whereMonth('created_at', '=', Carbon::now()->subMonth()->month(1))->count();
        // $lastPick = Dropoff::whereMonth('created_at', '=', Carbon::now()->subMonth()->month(1))->count();
        // $thisDrop = Dropoff::whereMonth('created_at','=', date('m'))->whereYear('created_at','=', date('Y'))->count();
        // $thisPick = Pickup::whereMonth('created_at','=', date('m'))->whereYear('created_at','=', date('Y'))->count();

        // $lastMonth = $lastDrop + $lastPick;
        // $thisMonth = $thisDrop + $thisPick;


        //todays sales
        $dropOffto = Dropoff::where('created_at', '>=' , Carbon::today())->pluck('price')->toArray();
        $pickUpto = Pickup::where('created_at', '>=' , Carbon::today())->pluck('price')->toArray();
        $todayOrder = array_sum($dropOffto) + array_sum($pickUpto);

        $warehouse = Warehouse::all()->pluck('quantity')->toArray();
        $warehousetotal = array_sum($warehouse);

        $bounceRate = $todayOrder/$total * 100;

        $data = [$user, $todayOrder, number_format($bounceRate,0), $warehousetotal, $total];
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

    public function provinceDataDrop()
    {
        $data = DB::table('dropoffs')
               ->select(DB::raw('branch, count(*) as count'))
               ->groupBy('branch')
               ->get();
               return response()->json($data);
    }

    public function provinceDataPick()
    {
        $data = DB::table('pickups')
               ->select(DB::raw('province, count(*) as count'))
               ->groupBy('province')
               ->get();
               return response()->json($data);
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
