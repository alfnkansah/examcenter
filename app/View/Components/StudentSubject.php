<?php

namespace App\View\Components;

use App\Models\Subject;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StudentSubject extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $subjects = Subject::all();
        return view('components.student-subject', compact('subjects'));
    }
}
