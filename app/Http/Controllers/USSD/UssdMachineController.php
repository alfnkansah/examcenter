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
        // Log::info($request);
        // Log::info($request['SESSIONID']);
        // Log::info($request->SESSIONID);

        Ussd::machine()->setSessionIdFromRequest('SESSIONID');

        $ussd = Ussd::machine()
            ->set([
                'phone_number' => $request['MSISDN'],
                'input' => $request['USERDATA'],
                'network' => $request['NETWORK'],
                'session_id' => $request['SESSIONID'],
            ])
            ->setInitialState(Welcome::class)
            ->setResponse(function (string $message, string $action) use ($request) {
                return [
                    'USERID' => $request['USERID'],
                    'MSISDN' => $request['MSISDN'],
                    'MSG' => $message,
                    'MSGTYPE' => $action == 'input' ? true : false,
                ];
            });
        return response()->json($ussd->run());
    }
}
