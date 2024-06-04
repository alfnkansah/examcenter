<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsHelper
{
    public static function sendSms($student, $customMessage)
    {
        $messageData = [
            'username' => 'alfnkansah',
            'password' => '0545Sunndayy#',
            'senderid' => 'CutoffCheck',
            'message' => $customMessage,
            'service' => 'SMS',
            'smstype' => 'text',
            'subject' => 'Message Subject',
            'destinations' => [
                [
                    'destination' => $student->phone_number,
                    'msgid' => 101
                ]
            ]
        ];

        try {
            $response = Http::withHeaders([
                "Content-Type" => "application/json"
            ])->post("https://frog.wigal.com.gh/api/v2/sendmsg", $messageData);

            Log::info($response);
            return $response;
        } catch (Exception $e) {
            Log::error("Error: " . $e->getMessage());
        }
    }
}
