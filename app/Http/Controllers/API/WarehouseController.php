<?php

namespace App\Http\Controllers\API;

use App\Shop;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //
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
        $shop = Shop::where('userId', $user->id)->get();
        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required|string|max:191',
            'quantity' => 'required|string|max:191',
            'weight' => 'required|numeric|between:0,99.99',
            'length' => 'required|numeric|between:0,99.99',
            'height' => 'required|numeric|between:0,99.99',
            'width' => 'required|numeric|between:0,99.99',
            'price' => 'price|numeric|between:0,9999.99',
        ]);

        Warehouse::create([
            'shopId' => $shop->id,
            'name' => $request['name'],
            'category' => $request['category'],
            'quantity' => $request['quantity'],
            'weight' => $request['weight'],
            'length' => $request['length'],
            'height' => $request['height'],
            'width' => $request['width'],
            'price' => $request['price']
        ]);
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
