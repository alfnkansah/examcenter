<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = Student::whereNotNull('full_name')->whereNotNull('level')->get();

        return view('students.index', compact('students'));
    }
}
