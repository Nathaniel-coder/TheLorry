<?php

namespace App\Http\Controllers;

use App\Dropoff;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class TwilioController extends Controller
{

    public function sendSMSDrop(Request $request)
    {
        $user = Dropoff::latest()->first();
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_TOKEN");
        $twilio_number = '+601155076051';
        $twilio = new Client($sid, $token);

        $to = $request->input('to');
        $message1 = $request->input('Thanks for your purchase. Your parcel will be delivered once you have delivered to the respective branch');

        $client = new Client($sid, $token);
            $client->messages->create('+601155076051', [
                'from' => $twilio_number,
                'body' => $message1]);

        return $client;
    }
    public function sendSMSPick(Request $request)
    {
        // $user = Dropoff::latest()->first();
        $sid = 'AC298c65112f9862183fa7d78448ce95ed';
        $token = 'feb5df6f647d6a50f6d817c92363113e';
        $twilio = new Client($sid, $token);

        $message = $twilio->messages->create(
            $request->input('to'),
            array(
                'from' => 'YOUR_TWILIO_PHONE_NUMBER',
                'body' => $request->input('message')
            )
        );

        return response()->json(['message' => 'SMS sent successfully']);
    }

}
