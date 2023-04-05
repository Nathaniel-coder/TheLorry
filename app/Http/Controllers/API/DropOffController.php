<?php

namespace App\Http\Controllers\API;

use App\Branch;
use App\Dropoff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DropOffController extends Controller
{
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
        $this->validate($request, [
            'date' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'phone' => 'required|string|max:15|min:10',
            'country' => 'required|string|max:191',
            'branch' => 'required|string|max:191',
            'toCountry' => 'required|string|max:191',
            'toProvince' => 'required|string|max:191',
            'toName' => 'required|string|max:191',
            'toPhone' => 'required|string|max:15|min:10',
            'toAddress1' => 'required|string|max:191',
            'toAddress2' => 'required|string|max:191',
            'toPostcode' => 'required|string|max:191',
            'toCity' => 'required|string|max:191',
        ]);

        return DropOff::create([
            'date' => $request['date'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'country' => $request['country'],
            'branch' => $request['branch'],
            'tocountry' => $request['toCountry'],
            'toprovince' => $request['toProvince'],
            'toname' => $request['toName'],
            'tophone' => $request['toPhone'],
            'toaddress1' => $request['toAddress1'],
            'toaddress2' => $request['toAddress2'],
            'topostcode' => $request['toPostcode'],
            'tocity' => $request['toCity']
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

    public function branches()
    {
        return Branch::all();
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


    public function count()
    {
        //staff
        $user = auth('api')->user();
        return Dropoff::where('phone', $user->phone)->count();
    }
}
