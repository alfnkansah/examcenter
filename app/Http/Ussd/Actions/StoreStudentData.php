<?php

namespace App\Http\Ussd\Actions;

use App\Http\Ussd\States\PreviewDownLoadRequest;
use App\Services\StudentResourceRequest;
use Sparors\Ussd\Action;

class StoreStudentData extends Action
{
    public function run(): string
    {
        $request = [];
        $request['student_id'] = $this->record->student;
        $request['student_name'] = $this->record->studentName;
        $request['student_level'] = $this->record->studentLevel;

        $newStudent =  (new StudentResourceRequest)->storeStudentDetails($request);

        return PreviewDownLoadRequest::class;


        return ''; // The state after this
    }
}
