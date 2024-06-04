<?php

namespace App\Http\Controllers;

use App\Helpers\NormalizePhoneNumber;
use App\Helpers\SmsHelper;
use App\Models\ResourceAnswer;
use App\Models\Student;
use App\Models\StudentResource;
use App\Services\StudentResourceRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DownloadResourceController extends Controller
{
    public function savePhoneNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_phone_number' => ['required', 'regex:/^(\+\d{1,3}[- ]?)?\d{10}$/'],
            'resourceID' => 'required'
        ], [
            'student_phone_number.required' => 'The phone number field is required.',
            'student_phone_number.regex' => 'Please enter your phone number in the format +1234567890, 123-456-7890, or 0240000000.',
        ]);

        // Apply additional validation if the phone number length is less than 10
        $validator->sometimes('student_phone_number', 'size:10', function ($input) {
            return strlen($input->student_phone_number) < 10;
        });

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $phoneNumber = NormalizePhoneNumber::normalizePhoneNumber($request->input('student_phone_number'));

        // Check if the student exists
        $student = Student::where('phone_number', $phoneNumber)->first();
        if ($student && $student->full_name !== null && $student->level !== null) {

            $oldStudent =  (new StudentResourceRequest)->notNewStudent($request, $student);
            return redirect()->route('preview.download', ['student' => $student->id, 'token' => $oldStudent->download_token]);
        }

        if ($student && $student->full_name == null && $student->level == null) {
            $oldStudent =  (new StudentResourceRequest)->notNewStudent($request, $student);
            return redirect()->route('submit.details', ['student' => $student->id, 'token' => $oldStudent->download_token]);
        }


        $newStudent =  (new StudentResourceRequest)->stageOne($request, $phoneNumber);

        $student = $newStudent['student'];
        $studentResource = $newStudent['studentResource'];

        // Redirect to the route with both IDs
        return redirect()->route('submit.details', ['student' => $student->id, 'token' => $studentResource->download_token]);
        // $newStudent =  (new StudentResourceRequest)->storeStudentDetails($request, $student, $phoneNumber);
    }

    public function saveStudentDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'resource_id' => 'required',
            'student_name' => 'required|string|max:255',
            'student_level' => 'required|integer|between:1,3',
        ], [
            'student_name.required' => 'Please enter your full name.',
            'student_name.string' => 'Your full name must be a string.',
            'student_name.max' => 'Your full name must not exceed 255 characters.',
            'student_level.required' => 'Please select your level.',
            'student_level.integer' => 'Your level must be an integer.',
            'student_level.between' => 'Please select a valid level.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $newStudent =  (new StudentResourceRequest)->storeStudentDetails($request);


        return redirect()->route('preview.download', ['student' => $request->student_id, 'token' => $request->resource_id]);
    }

    public function verifyLink(Request $request)
    {

        $resource = StudentResource::where('download_token', $request->token)->first();
        if ($resource) {
            $file = $resource->resource;

            $expirationDate = Carbon::parse($resource->expires_at);
            if ($expirationDate->isFuture()) {
                return view('download-page', compact('resource', 'file'));
            } else {
                return view('invalid-token', compact('resource'));
            }
        } else {
            return view('token-not-found', compact('resource'));
        }
    }


    public function smsRequestSent(Request $request)
    {
        $studentResource = StudentResource::findOrFail($request->resource_id);

        $student = $studentResource->student;

        // Generate URL with token
        $url = URL::signedRoute('verify-token', ['token' => $studentResource->download_token]);

        // Construct custom message with the URL
        $customMessage = "You have requested access to download a resource from " . env('APP_NAME') . ". Please find the download link below:" . "\n\n" . $url . "\n\nThis link will expire in 30 minutes. Please make sure to download the resource within this time frame. \n Thank you for using our service.";

        // Send SMS
        $sendLink = SmsHelper::sendSms($student, $customMessage);
        if ($sendLink->successful()) {
            $responseBody = $sendLink->json();
            if ($responseBody['status'] === 'ACCEPTED') {
                return redirect()->route('verify-token', $studentResource->download_token)->with(['success' => 'Link Successfully Sent']);
            } else {
                return redirect()->back()->with(['error' => 'Message could not be sent, please try again'], 400);
            }
        } else {
            return redirect()->back()->with(['error' => 'Failed to send message'], 500);
        }
    }



    // viewAnswerStudent

    public function viewAnswerStudent(Request $request, $id)
    {
        $resource = ResourceAnswer::where('resource_id', $id)->first();

        return view('answer-view', compact('resource'));
    }
}
