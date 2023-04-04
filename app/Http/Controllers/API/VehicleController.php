<?php

namespace App\Http\Controllers\API;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vehicle::orderByRaw('created_at', 'Desc')->paginate(5);
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
            'platno' => 'required|string|max:10',
            'brand' => 'required|string|max:191',
            'model' => 'required|string|max:191',
            'category' => 'required',
            'year' => 'required',
            'situated' => 'required',
            'availability' => 'required'
        ]);

        return Vehicle::create([
            'platno' => $request['platno'],
            'brand' => $request['brand'],
            'model' => $request['model'],
            'category' => $request['category'],
            'year' => $request['year'],
            'situated' => $request['situated'],
            'availability' => $request['availability']
        ]);
    }

    public function search()
    {
        if($search = \Request::get('q')){
            $users = Vehicle::where(function($query) use ($search){
                $query->where('platno', 'LIKE', "%$search%")
                ->orWhere('brand', 'Like', "%$search%")
                ->orWhere('model', 'Like', "%$search%");
            })->paginate(5);

        }else{
            $users = User::where('type' ,'!=', 'Customer')->latest()->paginate(5);
        }
        return $users;

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function branch()
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
        $vehicle = Vehicle::findorFail($id);
        $this->validate($request, [
            'platno' => 'required|string|max:10',
            'brand' => 'required|string|max:191',
            'model' => 'required|string|max:191',
            'category' => 'required',
            'year' => 'required',
            'situated' => 'required',
            'availability' => 'required'
        ]);

        $vehicle->update([
            'platno' => $request['platno'],
            'brand' => $request['brand'],
            'model' => $request['model'],
            'category' => $request['category'],
            'year' => $request['year'],
            'situated' => $request['situated'],
            'availability' => $request['availability']
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
        $vehicle = Vehicle::findorFail($id);
        $vehicle->delete();
        //delete the vehicle

        return ['message' => 'vehicle Deleted'];
    }
}
