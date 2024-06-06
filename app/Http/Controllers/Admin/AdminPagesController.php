<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FormatNumber;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GreetingController;
use App\Models\ExamCategory;
use App\Models\ExamType;
use App\Models\Level;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Matcher\Subset;
use Shetabit\Visitor\Models\Visit;

class AdminPagesController extends Controller
{
    public function index(Request $request)
    {
        $timezone = $request->session()->get('user_timezone');

        $greetingController = new GreetingController();
        $greeting = $greetingController->greetUser($timezone);

        $classes = Level::count();
        $subjects = Subject::count();


        $visit = Visit::all();
        $visitors = $visit->unique('ip')->count();
        $formattedVisitors = FormatNumber::formatNumber($visitors);

        $countVisist = FormatNumber::formatNumber($visit->count());
        $countUsers = FormatNumber::formatNumber(User::where('email', '!=', 'obimpehjohn1@gmail.com')->count());

        $today = date('Y-m-d');
        $visitToday = FormatNumber::formatNumber(Visit::whereDate('created_at', $today)->distinct('ip')->count());

        $startDate = date('Y-m-d', strtotime('-7 days'));
        $endDate = date('Y-m-d');
        $visitLastSevenDays = FormatNumber::formatNumber(Visit::whereBetween('created_at', [$startDate, $endDate])->distinct('ip')->count());

        $monthStart = date('Y-m-d', strtotime('-30 days'));
        $monthEnd = date('Y-m-d');

        $visitLastMonth = FormatNumber::formatNumber(Visit::whereBetween('created_at', [$monthStart, $monthEnd])->distinct('ip')->count());

        return view('dashboard', compact(
            'timezone',
            'greeting',
            'classes',
            'subjects',
            'formattedVisitors',
            'countVisist',
            'countUsers',
            'visitToday',
            'visitLastSevenDays',
            'visitLastMonth'
        ));
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

    public function viewUsers()
    {
        $users = User::where('email', '!=', 'obimpehjohn1@gmail.com')->get();
        // dd($users);
        return view('users.index', compact('users'));
    }
}
