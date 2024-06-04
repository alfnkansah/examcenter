<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use App\Models\ExamType;
use App\Models\Resource;
use App\Models\Student;
use App\Models\StudentResource;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomePagesController extends Controller
{
    public function index()
    {
        $exams = ExamType::all();
        return view('home', compact('exams'));
    }

    public function libraries()
    {

        $exams = ExamType::all();
        $subjects = Subject::with('examType')->take(8)->get();


        return view('frontend.libraries', compact('exams', 'subjects'));
    }

    public function lessons()
    {
        return view('frontend.lesson');
    }


    public function answerLibraries()
    {
        $exams = ExamType::all();
        $subjects = Subject::with('examType')->take(8)->get();


        return view('frontend.answer-libraries', compact('exams', 'subjects'));
    }

    public function viewExamLibrary($slug, $id)
    {
        $exam = ExamType::findOrFail($id);

        if ($exam->slug !== $slug) {
            abort(404);
        }

        $subjects = $exam->subjects;

        return view('frontend.view-library', compact('exam', 'subjects'));
    }


    public function viewSubjectPasco($id)
    {
        $category = ExamCategory::findOrFail($id);

        $resources = $category->resource;
        $subjects = $category->examType->subjects;
        return view('frontend.view-pasco', compact('resources', 'category', 'subjects', 'id'));
    }

    public function viewAnswerPasco($id)
    {
        $category = ExamCategory::findOrFail($id);

        $resources = $category->resource;
        $subjects = $category->examType->subjects;
        return view('frontend.view-answer', compact('resources', 'category', 'subjects', 'id'));
    }





    public function allSubjects()
    {
        return view('frontend.all-subjects');
    }

    public function fetchContent($examType)
    {

        $categories = ExamCategory::where('exam_type_id', $examType)->get();

        $html = view('partials.subjects', ['subjects' => $categories])->render();

        return response()->json(['html' => $html]);
    }

    public function fetchAllSubjects()
    {
        // Fetch all subjects
        $categories = ExamCategory::all();

        $html = view('partials.subjects', ['subjects' => $categories])->render();

        // Return subjects as JSON response
        return response()->json(['html' => $html]);
    }


    public function fetchContentAnswer($examType)
    {

        $categories = ExamCategory::where('exam_type_id', $examType)->get();

        $html = view('partials.answers', ['subjects' => $categories])->render();

        return response()->json(['html' => $html]);
    }

    public function fetchAllAnswer()
    {
        // Fetch all subjects
        $categories = ExamCategory::all();

        $html = view('partials.answers', ['subjects' => $categories])->render();

        // Return subjects as JSON response
        return response()->json(['html' => $html]);
    }


    public function fetchAnswerContent($examType)
    {

        $categories = ExamCategory::where('exam_type_id', $examType)->get();

        $html = view('partials.answers', ['subjects' => $categories])->render();

        return response()->json(['html' => $html]);
    }

    public function fetchAnswerAllSubjects()
    {
        // Fetch all subjects
        $categories = ExamCategory::all();

        $html = view('partials.answers', ['subjects' => $categories])->render();

        // Return subjects as JSON response
        return response()->json(['html' => $html]);
    }



    public function submitNumber(Resource $resource)
    {
        $resourceID = $resource->id;
        return view('frontend.submit-number', compact('resourceID'));
    }

    public function submitOtherDetails(Student $student, $token)
    {
        $studentID = $student->id;
        return view('frontend.submit-details', compact('studentID', 'token'));
    }

    public function downloadPreview(Student $student, $token)
    {
        // $resource = StudentResource::findOrFail($token);
        $resource = StudentResource::where('download_token', $token)->first();
        $relatedResource = $resource->resource;
        // dd($relatedResource);
        $relatedStudent = $resource->student;

        return view('frontend.confirm-download', compact('resource', 'relatedResource', 'relatedStudent'));
    }
}
