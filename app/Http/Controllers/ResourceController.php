<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use App\Models\ExamType;
use App\Models\Level;
use App\Models\QuestionType;
use App\Models\Resource;
use App\Models\ResourceAnswer;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Mockery\Matcher\Subset;

class ResourceController extends Controller
{
    public function index()
    {
        return view('resources.index');
    }

    public function create()
    {
        $exams = ExamType::all();
        $subjects = Subject::all();
        $levels = Level::all();
        $QuestionType = QuestionType::all();
        return view('resources.create', compact('exams', 'subjects', 'QuestionType', 'levels'));
    }

    public function storeResource(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'level_id' => 'required|exists:levels,id',
            'exam_category_id' => 'required|exists:exam_categories,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'subject_id' => 'required|exists:subjects,id',
            'question_type' => 'required|exists:question_types,id',

            'question_file' => 'required|file|mimes:pdf|max:20240',
            'answer_file' => 'required|file|mimes:pdf|max:20240',
            'exam_year' => 'required|integer|between:2000,' . now()->year,
        ]);

        // If validation fails, return the validation errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $resourceExists = Resource::where([
            'exam_type_id' => $request->exam_type_id,
            'subject_id' => $request->subject_id,
            'question_type_id' => $request->question_type,
            'level_id' => $request->level_id,
            'exam_category_id' => $request->exam_category_id,
            'exam_year' => $request->exam_year,
        ])->exists();

        // If the resource does not exist, return with an error message
        if ($resourceExists) {
            return redirect()->back()
                ->with('warning', 'Resource already exists for the selected exam, subject, question type, and year. Please upload a different file.');
        }

        $examType = ExamType::find($request->exam_type_id);
        $subject = Subject::find($request->subject_id);
        $questionType = QuestionType::find($request->question_type);
        $uniqueId = uniqid();
        $answerFile = $request->file('answer_file');

        // Construct file names
        $questionFileName = $examType->short_name . '_' . $subject->slug . '_' . $questionType->name . '_' . $request->exam_year . '_' . 'question' . '_' .  $uniqueId . '.pdf';
        $answerFileName = $examType->short_name . '_' . $subject->slug . '_' . $questionType->name . '_' . $request->exam_year . '_' . 'answer' . '_'  . $uniqueId . '.pdf';

        // Create a new resource record
        $resource = new Resource();
        $resource->level_id = $request->level_id;
        $resource->exam_type_id = $request->exam_type_id;
        $resource->exam_category_id = $request->exam_category_id;
        $resource->subject_id = $request->subject_id;
        $resource->question_type_id = $request->question_type;
        $resource->exam_year = $request->exam_year;
        $resource->file_path = '';

        if (!$resource->save()) {
            return redirect()->back()->with('error', 'Failed to save resource record.');
        }

        $questionFilePath = $request->file('question_file')->storeAs('public/question_files', $questionFileName);

        // Remove the 'public/' prefix before saving to the database
        $cleanedFilePath = str_replace('public/', '', $questionFilePath);

        // Update the resource record with file paths
        $resource->file_path = $cleanedFilePath;
        $resource->save();


        $saveAnswer = $this->storeResourceAnswer($resource, $answerFileName, $answerFile);

        return redirect()->back()->with('success', 'Resource uploaded successfully.');
    }

    private function storeResourceAnswer($resource, $answerFileName, $answerFile)
    {
        $answerFilePath = $answerFile->storeAs('public/answer_files', $answerFileName);
        $cleanedFilePath = str_replace('public/', '', $answerFilePath);


        $answer = new ResourceAnswer();
        $answer->resource_id = $resource->id;
        $answer->file_path = $cleanedFilePath;
        $answer->save();

        return true;
    }

    public function getCourses(Request $request)
    {
        $examId = $request->input('exam_type_id');

        $subjects = Subject::where('exam_type_id', $examId)
            ->get();

        return response()->json($subjects);
    }

    public function getCategory(Request $request)
    {
        $examId = $request->input('exam_type_id');

        $subjects = ExamCategory::where('exam_type_id', $examId)
            ->get();

        return response()->json($subjects);
    }
}
