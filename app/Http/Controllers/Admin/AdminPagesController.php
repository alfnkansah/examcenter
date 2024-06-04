<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GreetingController;
use App\Models\ExamCategory;
use App\Models\ExamType;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Matcher\Subset;

class AdminPagesController extends Controller
{
    public function index(Request $request)
    {
        $timezone = $request->session()->get('user_timezone');

        $greetingController = new GreetingController();
        $greeting = $greetingController->greetUser($timezone);

        $classes = Level::count();
        $subjects = Subject::count();
        return view('dashboard', compact('timezone', 'greeting', 'classes', 'subjects'));
    }

    public function examsTypes()
    {
        $examsTypes = ExamType::all();
        return view('exams.index', compact('examsTypes'));
    }

    public function levels()
    {
        $levels = Level::all();
        return view('level.index', compact('levels'));
    }
    public function subjects()
    {
        $subjects = Subject::all();
        return view('subject.index', compact('subjects'));
    }


    public function getUserTimezone(Request $request)
    {
        $timezone = $request->timezone;
        session(['user_timezone' => $timezone]);

        return response()->json(['message' => 'User timezone saved successfully']);
    }

    public function examsCategory()
    {
        $categories = ExamCategory::all();
        return view('category.index', compact('categories'));
    }
}
