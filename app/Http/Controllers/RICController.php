<?php

namespace App\Http\Controllers;

use App\User;
use App\Pickup;
use ZipArchive;
use App\Dropoff;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Exports\PickUpExport;
use App\Exports\ExportDropOff;
use App\Exports\ExportDelivery;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ExportWarehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Facade\FlareClient\Http\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        if ($type != 'Administrator' && $type != 'Staff') {
            $dropOff = Dropoff::where('phone', $phone)->orderBy('created_at', 'DESC')->get();
            $pickUP = Pickup::where('phone', $phone)->orderBy('created_at', 'DESC')->get();
        } else {
            $dropOff = Dropoff::orderByRaw('created_at', 'Desc')->paginate(5);
            $pickUP = Pickup::orderByRaw('created_at', 'Desc')->paginate(5);
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
        return View('invoice', [
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
        return response()->view('pickXML', ['XML' => $XML])->header('Content-Type', 'text/xml');
    }

    public function XMLDrop($id)
    {
        $XML = Dropoff::findorFail($id);
        return response()->view('dropXML', ['XML' => $XML])->header('Content-Type', 'text/xml');
    }

    public function XMLRates()
    {
        return response()->view('Rates')->header('Content-Type', 'text/xml');
    }
    public function PickXMLAll()
    {
        if (Auth::user()->type != 'Customer') {
            $data = Pickup::all();
            return response()->view('XML', ['data' => $data])->header('Content-Type', 'text/xml');
        } else {
            $data = Pickup::where('phone', Auth::user()->phone)->get();
            return response()->view('XML', ['data' => $data])->header('Content-Type', 'text/xml');
        }
    }
    public function DropXMLAll()
    {
        if (Auth::user()->type != 'Customer') {
            $data = Dropoff::all();
            return response()->view('XML', ['data' => $data])->header('Content-Type', 'text/xml');
        } else {
            $data = Dropoff::where('phone', Auth::user()->phone)->get();
            return response()->view('XML', ['data' => $data])->header('Content-Type', 'text/xml');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DropCSV()
    {
        return Excel::download(new ExportDropOff, 'DropOff.csv');
    }
    public function PickCSV()
    {
        return Excel::download(new PickUpExport, 'PickUp.csv');
    }

    public function WarehouseCSV()
    {
        return Excel::download(new ExportWarehouse, 'Warehouse.csv');
    }
    public function CSV()
    {
        return Excel::download(new ExportDelivery, 'Delivery.csv');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DropQR($id)
    {
        $data = Dropoff::where('id', $id)->get();

        $qrcode = QrCode::size(250)->generate(json_encode($data, JSON_PRETTY_PRINT));
        $pdf = Pdf::loadView('QrCode', 'qrcode');

        return $pdf->download('qr_code' . $id . '.pdf');
    }

    public function pickQR($id)
    {
        $data = Pickup::where('id', $id)->get();

        $qrcode = QrCode::size(250)->generate(json_encode($data, JSON_PRETTY_PRINT));
        $pdf = Pdf::loadView('QrCode', ['qrcode' => $qrcode]);

        return $pdf->download('qr_code' . $id . '.pdf');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ConsignmentDrop()
    {
        $user = Auth::user();
        $data = Dropoff::where('phone', $user->phone)->orderByRaw('created_at', 'Desc')->first();
        return view('Consignment', ['data' => $data]);
    }
    public function ConsignmentPick()
    {
        $user = Auth::user();
        $data = Pickup::where('phone', $user->phone)->orderByRaw('created_at', 'Desc')->first();
        return view('Consignment', ['data' => $data]);
    }
    public function DropConsignment($id)
    {
        $data = Dropoff::findOrFail($id);
        return view('Consignment', ['data' => $data]);
    }
    public function PickConsignment($id)
    {
        $data = Pickup::findOrFail($id);
        return view('Consignment', ['data' => $data]);
    }

    public function download(Request $request)
    {
        $ids = $request->input('ids');
        $rows = DB::table('my_table')->whereIn('id', $ids)->get();

        // Step 5: Create a zip file and add the data to it
        $zip = new ZipArchive;
        $zip->open(storage_path('app/temp.zip'), ZipArchive::CREATE);
        foreach ($rows as $row) {
            $zip->addFromString($row->filename, $row->data);
        }
        $zip->close();

        // Step 6: Return a download response to the user
        return response()->download(storage_path('app/temp.zip'))->deleteFileAfterSend(true);
    }
}
