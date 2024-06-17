<?php

namespace App\Http\Ussd\Actions;

use App\Helpers\SmsHelper;
use App\Http\Ussd\States\ShowFinalDownloadMessage;
use App\Models\StudentResource;
use Illuminate\Support\Facades\URL;
use Sparors\Ussd\Action;

class SendUssdSMS extends Action
{
    public function run(): string
    {

        $studentResource = StudentResource::findOrFail($this->record->get('student_resource_id'));
        $student = $studentResource->student;

        $url = URL::signedRoute('verify-token', ['token' => $studentResource->download_token]);

        // Construct custom message with the URL
        $customMessage = "You have requested access to download a resource from " . env('APP_NAME') . ". Please find the download link below:" . "\n\n" . $url . "\n\nThis link will expire in 30 minutes. Please make sure to download the resource within this time frame. \n Thank you for using our service.";
        $sendLink = SmsHelper::sendSms($student, $customMessage);

        if ($sendLink->successful()) {
            $responseBody = $sendLink->json();
            if ($responseBody['status'] === 'ACCEPTED') {
                $msg = "Thank you! you will receive and sms shortly";
                $this->record->set('finalMessage', $msg);
                return ShowFinalDownloadMessage::class;
            } else {
                $msg = "Sorry we are unable to send sms at the moment please try again";
                $this->record->set('finalMessage', $msg);
                return ShowFinalDownloadMessage::class;
            }
        } else {
            $msg = "Sorry we are unable to send sms at the moment please try again";
            $this->record->set('finalMessage', $msg);
            return ShowFinalDownloadMessage::class;
        }

        // return ''; // The state after this
    }
}
