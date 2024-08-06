<?php

namespace App\Http\Ussd\Actions;

use App\Helpers\SmsHelper;
use App\Http\Ussd\States\ShowFinalDownloadMessage;
use App\Models\StudentResource;
use App\Services\TinyUrlService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Sparors\Ussd\Action;

class SendUssdSMS extends Action
{
    public function run(): string
    {

        $studentResource = StudentResource::findOrFail($this->record->get('student_resource_id'));
        $student = $studentResource->student;

        $url = URL::signedRoute('verify-token', ['token' => $studentResource->download_token]);
        $tinyUrlService = app(TinyUrlService::class);
        // $shortenedUrl = $tinyUrlService->shortenUrls($url);
        // Log::info($url);
        // Log::info($shortenedUrl);

        $shortenedLink = $tinyUrlService->shortenUrl($url);

        // Construct custom message with the URL
        $customMessage = "Thank you for using ExamCenter!\n\nTap on the link to download " . $this->record->get('resource_name') . "\n\n" . $shortenedLink . "\n\nThis link expires in 30 mins.";

        $sendLink = SmsHelper::sendSms($student, $customMessage);
        if ($sendLink->successful()) {
            $responseBody = $sendLink->json();
            if ($responseBody['status'] === 'ACCEPTED') {
                $msg = "Thank you! and you will receive an sms shortly";
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
