<?php

namespace App\Http\Controllers\API;

use App\Branch;
use App\User;
use App\Pickup;
use App\Dropoff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Shop;
use App\Vehicle;
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


        //todays sales
        $dropOffto = Dropoff::where('created_at', '>=', Carbon::today())->pluck('price')->toArray();
        $pickUpto = Pickup::where('created_at', '>=', Carbon::today())->pluck('price')->toArray();
        $todayOrder = array_sum($dropOffto) + array_sum($pickUpto);

        $warehouse = Warehouse::all()->pluck('quantity')->toArray();
        $warehousetotal = array_sum($warehouse);

        $bounceRate = $todayOrder / $total * 100;

        $vehicle = Vehicle::count();
        $branches = Branch::count();
        $data = [$user, $todayOrder, number_format($bounceRate, 0), $warehousetotal, $total, $vehicle, $branches];
        return $data;
    }

    public function DropCount()
    {
        $user = auth('api')->user();
        if ($user->type == 'Administrator') {
            return Dropoff::count();
        } else {
            return Dropoff::where('phone', $user->phone)->count();
        }
    }

    public function PickCount()
    {
        $user = auth('api')->user();
        if ($user->type == 'Administrator') {
            return Pickup::count();
        } else {
            return Pickup::where('phone', $user->phone)->count();
        }
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

    // public function provinceDataDrop()
    // {
    //     $data = DB::table('dropoffs')
    //         ->select(DB::raw('branch, count(*) as count'))
    //         ->groupBy('branch')
    //         ->get();
    //     return response()->json($data);
    // }

    // public function provinceDataPick()
    // {
    //     $data = DB::table('pickups')
    //         ->select(DB::raw('province, count(*) as count'))
    //         ->groupBy('province')
    //         ->get();
    //     return response()->json($data);
    // }

    public function chartData()
    {
        $dropOffData = DropOff::where('status', '!=', 'Unpaid')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('created_at')
            ->get();

        $pickupData = Pickup::where('status', '!=', 'Unpaid')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('created_at')
            ->get();

            //Carbon::parse($data->date)->format('d/m/Y');
            //groupby()
            //then |
            //

        $chartData = [];

        foreach ($dropOffData as $data) {
            $date = Carbon::parse($data->date)->format('d/m/Y');
            $chartData[$date]['dropOffCount'] = $data->count;
        }

        foreach ($pickupData as $data) {
            $date = Carbon::parse($data->date)->format('d/m/Y');
            $chartData[$date]['pickupCount'] = $data->count;
        }

        $finalChartData = [];

        foreach ($chartData as $date => $data) {
            $finalChartData[] = [
                'date' => $date,
                'dropOffCount' => $data['dropOffCount'] ?? 0,
                'pickupCount' => $data['pickupCount'] ?? 0
            ];
        }

        return response()->json($finalChartData);
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
    public function donutdrop()
    {
        $DropCount = Dropoff::where('status', '!=', 'Unpaid')->whereDate('created_at', today())->get();
        $UnpaidDropCount = Dropoff::whereDate('created_at', today())->get();
        $PickCount = Pickup::where('status', '!=', 'Unpaid')->whereDate('created_at', today())->get();
        $UnpaidPickCount = Pickup::whereDate('created_at', today())->get();

        $chartData = [
            [
                'label' => 'Conversion Rate',
                'value' => number_format(($DropCount->sum('price') + $PickCount->sum('price'))/($UnpaidDropCount->sum('price') + $UnpaidPickCount->sum('price')),2),
            ],
            [
                'label' => 'Drop Off Purchases',
                'value' => $DropCount->sum('price'),
            ],
            [
                'label' => 'Pick Up Purchases',
                'value' => $PickCount->sum('price'),
            ],
            [
                'label' => 'Total Orders',
                'value' => $UnpaidDropCount->sum('price') + $UnpaidPickCount->sum('price'),
            ]
        ];
        return response()->json($chartData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function warehouseChart()
    {
        $user = auth('api')->user();
        if ($user->type == 'Merchant') {
            $shop = Shop::where('userId', $user->id)->first();
            $items = Warehouse::where('user', $shop->shopname)->get();

            $groupedItems = $items->groupBy('category');

            $chartData = [];

            foreach ($groupedItems as $category => $items) {
                $quantity = $items->sum('quantity');
                $chartData[] = [
                    'category' => $category,
                    'quantity' => $quantity
                ];
            }

            return response()->json($chartData);
        } else {
            $items = Warehouse::all();
            $groupedItems = $items->groupBy('category');
            $chartData = [];

            foreach ($groupedItems as $category => $items) {
                $quantity = $items->sum('quantity');
                $chartData[] = [
                    'category' => $category,
                    'quantity' => $quantity
                ];
            }

            return response()->json($chartData);
        }
    }
    public function brandChart()
    {
        $user = auth('api')->user();
        if ($user->type == 'Merchant') {
            $shop = Shop::where('userId', $user->id)->first();
            $items = Warehouse::where('user', $shop->shopname)->get();

            $groupedItems = $items->groupBy('name');

            $chartData = [];

            foreach ($groupedItems as $name => $items) {
                $quantity = $items->sum('quantity');
                $chartData[] = [
                    'name' => $name,
                    'quantity' => $quantity
                ];
            }

            return response()->json($chartData);
        } else {
            $items = Warehouse::all();
            $groupedItems = $items->groupBy('name');

            $chartData = [];

            foreach ($groupedItems as $name => $items) {
                $quantity = $items->sum('quantity');
                $chartData[] = [
                    'name' => $name,
                    'quantity' => $quantity
                ];
            }
            return response()->json($chartData);
        }
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
