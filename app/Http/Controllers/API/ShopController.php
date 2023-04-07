<?php

namespace App\Http\Controllers\API;

use App\Branch;
use App\User;
use App\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
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

        $this->validate($request, [
            'shopname' => 'required|string|max:191',
            'niche' => 'required|string|max:191',
            'companyliscence' => 'required|string|max:191',
            'branchid' => 'required|string|max:191',
        ]);


        Shop::create([
            'userId' => $user->id,
            'branchId' => $request['branchid'],
            'shopname' => $request['shopname'],
            'companyliscence' => $request['companyliscence'],
            'niche' => $request['niche']
        ]);

        $user->update([
            'type' => "Merchant"
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
    public function update(Request $request)
    {

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
