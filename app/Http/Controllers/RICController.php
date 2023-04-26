<?php

namespace App\Http\Controllers;

use App\User;
use App\Pickup;
use App\Dropoff;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Exports\PickUpExport;
use App\Exports\ExportDropOff;
use App\Exports\ExportWarehouse;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Facade\FlareClient\Http\Response;


class RICController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = Auth::user()->type;
        $phone = Auth::user()->phone;
        $dropOff = '';
        $pickUP = '';
        if ($type == 'Customer') {
            $dropOff = Dropoff::where('phone', $phone)->orderBy('created_at', 'DESC')->get();
            $pickUP = Pickup::where('phone', $phone)->orderBy('created_at', 'DESC')->get();
        } else {
            $dropOff = Dropoff::all();
            $pickUP = Pickup::all();
        }

        return view('receipt&Invoice', ['dropOff' => $dropOff, 'pickUp' => $pickUP]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoiceDrop($id)
    {
        $data = Dropoff::findOrFail($id);
         return View('invoice',[
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invoicePick($id)
    {
        $data = Pickup::findorFail($id);
        // $auth = User::where('name', $pickUp->name)->get();
        return View('invoice', [
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function XMLPick($id)
    {
        $XML = Pickup::findorFail($id);
        return response()->view('pickXML', ['XML'=>$XML])->header('Content-Type', 'text/xml');
    }

    public function XMLDrop($id)
    {
        $XML = Dropoff::findorFail($id);
        return response()->view('dropXML', ['XML'=>$XML])->header('Content-Type', 'text/xml');
    }

    public function XMLRates()
    {
        return response()->view('Rates')->header('Content-Type', 'text/xml');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DropCSV()
    {
        return Excel::download(new ExportDropOff, 'DropOff.xlsx');
    }
    public function PickCSV()
    {
        return Excel::download(new PickUpExport, 'PickUp.xlsx');
    }

    public function WarehouseCSV()
    {
        return Excel::download(new ExportWarehouse, 'Warehouse.xlsx');
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
