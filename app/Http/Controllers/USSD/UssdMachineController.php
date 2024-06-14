<?php

namespace App\Http\Controllers\USSD;

use App\Http\Controllers\Controller;
use App\Http\Ussd\States\Welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\Facades\Ussd;

class UssdMachineController extends Controller
{
    public function startUSSD(Request $request)
    {
        // Read incoming data
        $data = $request->all();
        Log::info($data);
        // Set your custom session id and start session for the incoming request
        $msisdn = $data['MSISDN'];
        session()->put('ussd_session_id', md5($msisdn));
        session()->start();

        // Get all incoming request parameters
        $ussd_id = $data['USERID'];
        $user_data = $data['USERDATA'];
        $msgtype = $data['MSGTYPE'];
        $id = session()->getId();

        // Subsequent dials
        if (session()->has($id) && !$msgtype) {
            session()->put($id, session()->get($id) . $user_data);
            $user_dials = preg_split("/\#\*\#/", session()->get($id));
            $msg = "Hello " . $user_dials[1] . ", Your initial dial was " . $user_dials[0] . "\nInputs were successfully stored and passed on to this screen.\nHappy Coding :)";
            $resp = [
                "USERID" => $ussd_id,
                "MSISDN" => $msisdn,
                "USERDATA" => $user_data,
                "MSG" => $msg,
                "MSGTYPE" => false
            ];
            return response()->json($resp);
            session()->forget($id);
        } else {
            // To reinitialize session variable in case the user cancelled initial screen
            if (session()->has($id) && $msgtype) {
                session()->forget($id);
            }

            // Stores user inputs using sessions
            session()->put($id, $user_data . "#*#");

            // Responds to request. MSG variable will be displayed on the user's screen
            $msg = "Welcome to NALO test demo\nThis is to help you get started with session/data management\nEnter your name please";
            $resp = [
                "USERID" => $ussd_id,
                "MSISDN" => $msisdn,
                "USERDATA" => $user_data,
                "MSG" => $msg,
                "MSGTYPE" => true
            ];
            return response()->json($resp);
        }
    }
}
