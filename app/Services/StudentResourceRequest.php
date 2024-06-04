<?php

namespace App\Services;

use Illuminate\Support\Str;

use App\Models\Student;
use App\Models\StudentResource;
use Carbon\Carbon;

class StudentResourceRequest
{
    public function stageOne($request, $phoneNumber)
    {
        $student = new Student();
        $student->phone_number = $phoneNumber;
        $student->save();

        // Generate download token and set expiration date
        $downloadToken = Str::random(40);
        $expirationDate = Carbon::now()->addMinutes(30);

        // Create student resource record
        $studentResource = new StudentResource();
        $studentResource->resource_id = $request->resourceID;
        $studentResource->student_id = $student->id;
        $studentResource->download_token = $downloadToken;
        $studentResource->expires_at = $expirationDate;
        $studentResource->save();

        return [
            'student' => $student,
            'studentResource' => $studentResource,
        ];
    }

    public function storeStudentDetails($request)
    {
        $student = Student::findOrfail($request->student_id);

        if (!$student) {
            return 404;
        }
        $student->full_name = $request->student_name;
        $student->level = $request->student_level;
        $student->save();

        return $student;
    }


    public function notNewStudent($request, $student)
    {
        // Generate download token and set expiration date
        $downloadToken = Str::random(40);
        $expirationDate = Carbon::now()->addMinutes(30);

        // Create student resource record
        $studentResource = new StudentResource();
        $studentResource->resource_id = $request->resourceID;
        $studentResource->student_id = $student->id;
        $studentResource->download_token = $downloadToken;
        $studentResource->expires_at = $expirationDate;
        $studentResource->save();

        return $studentResource;
    }
}
