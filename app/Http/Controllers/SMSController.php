<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function send(Request $request){
        $receiverNumber = $request->phone;
        $message = $request->message;
        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);
        return redirect()->back()->with("success","تم إرسال الرسالة بنجاح");
        }catch (Exception $e){
            return redirect()->back()->with("faild", $e->getMessage());
        }
    }
}
