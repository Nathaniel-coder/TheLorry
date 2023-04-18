<?php

namespace App\Http\Controllers\API;

use App\Dropoff;
use App\Pickup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class XMLController extends Controller
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
     * Drop Off Truck XML -> QR CODE
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function DropXML($id)
    {
        $data = Dropoff::where('id', $id)->get();

        $xml = new \SimpleXMLElement('<?xml version="1.0"?><dropOff></dropOff>');
        foreach ($data as $dropOff) {
            $dropOffElement = $xml->addChild('From');
            $dropOffElement->addChild('Date', $dropOff->date);
            $dropOffElement->addChild('id', $dropOff->id);
            $dropOffElement->addChild('Name', $dropOff->name);
            $dropOffElement->addChild('Phone', $dropOff->phone);
            $dropOffElement->addChild('Dropoff', $dropOff->branch);
            $dropOffElement = $xml->addChild('To');
            $dropOffElement->addChild('Name', $dropOff->toname);
            $dropOffElement->addChild('Phone', $dropOff->tophone);
            $dropOffElement->addChild('Destination', $dropOff->toaddress1 . ', ' . $dropOff->toaddress2 . ', ' . $dropOff->topostcode . ' ' . $dropOff->tocity . ', ' . $dropOff->toprovince . ', ' . $dropOff->tocountry);
            $pickupElement = $xml->addChild('Driver');
            $pickupElement->addChild('Driver', $dropOff->driverId);
            $pickupElement->addChild('Vehicle', $dropOff->vehicleId);
            // add other data elements as needed
        }
        $xml->asXML(public_path('/XML/Delivery/DropOff/dropOff' . $id . '.xml'));
    }

    /**
     * Pick Up Truck XML -> QR CODE
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PickXML($id)
    {
        // return phpinfo();
        $data = Pickup::where('id', $id)->get();

        $xml = new \SimpleXMLElement('<?xml version="1.0"?><pickup></pickup>');
        foreach ($data as $pickup) {
            $pickupElement = $xml->addChild('From');
            $pickupElement->addChild('Date', $pickup->date);
            $pickupElement->addChild('id', $pickup->id);
            $pickupElement->addChild('Name', $pickup->name);
            $pickupElement->addChild('Phone', $pickup->phone);
            $pickupElement->addChild('Address', $pickup->address1 . ', ' . $pickup->address2 . ', ' . $pickup->postcode . ' ' . $pickup->city . ', ' . $pickup->province . ', ' . $pickup->country);
            $pickupElement = $xml->addChild('To');
            $pickupElement->addChild('Name', $pickup->toname);
            $pickupElement->addChild('Phone', $pickup->tophone);
            $pickupElement->addChild('Destination', $pickup->toaddress1 . ', ' . $pickup->toaddress2 . ', ' . $pickup->topostcode . ' ' . $pickup->tocity . ', ' . $pickup->toprovince . ', ' . $pickup->tocountry);
            $pickupElement = $xml->addChild('Driver');
            $pickupElement->addChild('Driver', $pickup->driverId);
            $pickupElement->addChild('Vehicle', $pickup->vehicleId);
            // add other data elements as needed
        }
        $xml->asXML(public_path('/XML/Delivery/PickUP/pickUp' . $id . '.xml'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function WarehouseItem($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Delivered($id)
    {
        //
    }
}
