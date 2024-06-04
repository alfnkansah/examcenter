<?php

namespace App\View\Components;

use App\Models\ExamType;
use App\Models\Subject;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubjectList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }


    public function render(): View|Closure|string
    {
        $exams = ExamType::with('subjects')->get();
        return view('components.subject-list', compact('exams'));
    }
}
