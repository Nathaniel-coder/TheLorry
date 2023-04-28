<?php

namespace App\Http\Controllers\API;

use App\Shop;
use App\User;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
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
        $user = auth('api')->user();
        if ($user->type == "Merchant") {
            return Warehouse::where('user', $user->name)->orderByRaw('created_at', 'Desc')->paginate(5);
        }

        if ($user->type != "Merchant" && $user->type != "Customer") {
            return Warehouse::orderByRaw('created_at', 'Desc')->paginate(5);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = Shop::where('userId', $user->id)->get();
        // return $shop->id;
        if ($user->type == "Merchant") {
            $this->validate($request, [
                'name' => 'required|string',
                'category' => 'required|string|max:191',
                'quantity' => 'required|numeric|between:0,999',
                'weight' => 'required|numeric|between:0,99.99',
                'length' => 'required|numeric|between:0,99.99',
                'height' => 'required|numeric|between:0,99.99',
                'width' => 'required|numeric|between:0,99.99',
            ]);

            return Warehouse::create([
                'user' => $data->shopname,
                'name' => $request['name'],
                'category' => $request['category'],
                'quantity' => $request['quantity'],
                'weight' => $request['weight'],
                'length' => $request['length'],
                'height' => $request['height'],
                'width' => $request['width'],
            ]);
        }
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
        $warehouse = Warehouse::findorFail($id);
        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required|string|max:191',
            'quantity' => 'required|numeric|between:0,999',
            'weight' => 'required|numeric|between:0,99.99',
            'length' => 'required|numeric|between:0,99.99',
            'height' => 'required|numeric|between:0,99.99',
            'width' => 'required|numeric|between:0,99.99',
        ]);

        $warehouse->update([
            'name' => $request['name'],
            'category' => $request['category'],
            'quantity' => $request['quantity'],
            'weight' => $request['weight'],
            'length' => $request['length'],
            'height' => $request['height'],
            'width' => $request['width'],
        ]);

        return ['message' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warehouse = Warehouse::findorFail($id);
        return $warehouse->delete();
    }
}
