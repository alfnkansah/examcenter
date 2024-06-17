<?php

namespace App\Http\Ussd\Actions;

use App\Http\Ussd\States\PreviewDownLoadRequest;
use App\Http\Ussd\States\TakeStudentDetails;
use App\Http\Ussd\States\TakeStudentName;
use App\Models\Student;
use App\Services\StudentResourceRequest;
use Illuminate\Support\Facades\Log;
use Sparors\Ussd\Action;

class TakeStudentData extends Action
{
    public function run(): string
    {
        $request = [];
        $request['resourceID'] = $this->record->selectedResource;

        $phoneNumber = $this->record->phoneNumber;
        $student = Student::where('phone_number', $phoneNumber)->first();

        if ($student && $student->full_name !== null && $student->level !== null) {
            $oldStudent =  (new StudentResourceRequest)->notNewStudent($request, $student);

            $this->record->setMultiple([
                'student' => $student->id,
                'token' => $oldStudent->download_token,
                'student_resource_id' => $oldStudent->id
            ]);

            return PreviewDownLoadRequest::class;
        }

        if ($student && $student->full_name == null && $student->level == null) {
            $oldStudent =  (new StudentResourceRequest)->notNewStudent($request, $student);
            $this->record->setMultiple([
                'student' => $student->id,
                'token' => $oldStudent->download_token,
                'student_resource_id' => $oldStudent->id
            ]);
            return TakeStudentName::class;
        }

        $newStudent =  (new StudentResourceRequest)->stageOne($request, $phoneNumber);

        $student = $newStudent['student'];
        $studentResource = $newStudent['studentResource'];

        $this->record->setMultiple([
            'student' => $student->id,
            'token' => $studentResource->download_token,
            'student_resource_id' => $studentResource->id
        ]);
        return TakeStudentName::class;
    }
}
