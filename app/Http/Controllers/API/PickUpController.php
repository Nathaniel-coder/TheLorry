<?php

namespace App\Http\Controllers\API;

use App\Pickup;
use App\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PickUpController extends Controller
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
        if($user->type == "Customer"){
            return Pickup::where('name' ,'!=', $user->name)->orderByRaw('created_at', 'Desc')->paginate(5);
        }

        return Pickup::orderByRaw('created_at', 'Desc')->paginate(5);
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
            'address1' => 'required|string|max:191',
            'address2' => 'required|string|max:191',
            'postcode' => 'required|string|max:191',
            'city' => 'required|string|max:191',
            'province' => 'required|string|max:191',
            'toName' => 'required|string|max:191',
            'toPhone' => 'required|string|max:15|min:10',
            'toAddress1' => 'required|string|max:191',
            'toAddress2' => 'required|string|max:191',
            'toPostcode' => 'required|string|max:191',
            'toCity' => 'required|string|max:191',
            'toProvince' => 'required|string|max:191',
            'toCountry' => 'required|string|max:191',
        ]);

        return Pickup::create([
            'date' => $request['date'],
            'name' => $request['name'],
            'phone' => $request['phone'],
            'country' => $request['country'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'postcode' => $request['postcode'],
            'city' => $request['city'],
            'province' => $request['province'],
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth('api')->user();
        // return ['message' => 'success'];
        if($user->type == 'Staff' || $user->type == 'Administrator'){
            $pickUp = Pickup::findorFail($id);
            $this->validate($request, [
                'driverId' => 'required',
                'vehicleId' => 'required'
            ]);

            $pickUp->update([
                'driverId' => $request['driverId'],
                'vehicleId' => $request['vehicleId'],
                'status' => 'In Progress'
            ]);
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

    public function count()
    {
        $user = auth('api')->user();
        return Pickup::where('phone', $user->phone)->count();
    }
}
