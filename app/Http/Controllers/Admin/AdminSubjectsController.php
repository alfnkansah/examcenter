<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;

class AdminSubjectsController extends Controller
{
    public function index()
    {
    }
    public function create()
    {
        $exams = ExamType::all();
        $levels = Level::all();

        return view('subject.create', compact('exams', 'levels'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'level_id' => 'required|exists:levels,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'name' => 'required|string|max:255',
            'tag' => 'required|string'
        ]);
        $data = $request->except(['_token']);

        $subjectExist = Subject::where('level_id', $request->level_id)->where('exam_type_id', $request->exam_type_id)->where('name', $request->name)->first();
        if (!$subjectExist == null) {
            return redirect()->back()->with('error', 'Subject is already in the system for this level and exam type.');
        }


        Subject::create($data);

        return redirect()->back()->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        $levels = Level::all();
        return view('subject.edit', compact('subject', 'levels'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'level_id' => 'required|exists:levels,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'name' => 'required|string|max:255',
            'tag' => 'required|string'
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
