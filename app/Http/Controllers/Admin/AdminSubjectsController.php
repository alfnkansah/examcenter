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
        // Validate the request
        $validatedData = $request->validate([
            'level_id' => 'required|exists:levels,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'name' => 'required|string|max:255',
            'tag' => 'required|string',
            'program_ids' => 'nullable|array|required_if:tag,elective',
            'program_ids.*' => 'exists:programs,id'
        ]);

        // Build the query for duplicate check
        $query = Subject::where('level_id', $validatedData['level_id'])
            ->where('exam_type_id', $validatedData['exam_type_id'])
            ->where('name', $validatedData['name']);

        if ($request->tag === 'elective' && !empty($validatedData['program_ids'])) {
            $query->whereHas('programs', function ($q) use ($validatedData) {
                $q->whereIn('program_id', $validatedData['program_ids']);
            });
        }

        $subjectExist = $query->first();

        if ($subjectExist !== null) {
            return redirect()->back()->with('error', 'Subject is already in the system for this level and exam type.')
                ->withInput($request->all());
        }

        // Create the subject
        $subject = Subject::create($validatedData);

        // Attach the selected programs if the tag is elective
        if ($request->tag === 'elective' && !empty($validatedData['program_ids'])) {
            $subject->programs()->attach($validatedData['program_ids']);
        }

        return redirect()->back()->with('success', 'Subject created successfully.');
    }






    public function edit(Subject $subject)
    {
        $levels = Level::all();
        return view('subject.edit', compact('subject', 'levels'));
    }


    public function update(Request $request, Subject $subject)
    {
        // Validate the request
        $validatedData = $request->validate([
            'level_id' => 'required|exists:levels,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'name' => 'required|string|max:255',
            'tag' => 'required|string',
            'program_ids' => 'nullable|array|required_if:tag,elective',
            'program_ids.*' => 'exists:programs,id'
        ]);

        // Build the query for duplicate check
        $query = Subject::where('level_id', $validatedData['level_id'])
            ->where('exam_type_id', $validatedData['exam_type_id'])
            ->where('name', $validatedData['name'])
            ->where('id', '!=', $subject->id);

        if ($request->tag === 'elective' && !empty($validatedData['program_ids'])) {
            $query->whereHas('programs', function ($q) use ($validatedData) {
                $q->whereIn('program_id', $validatedData['program_ids']);
            });
        }

        $subjectExist = $query->first();

        if ($subjectExist !== null) {
            return redirect()->back()->with('error', 'Subject is already in the system for this level and exam type.')
                ->withInput($request->all());
        }

        // Update the subject
        $subject->update($validatedData);

        // Sync the selected programs if the tag is elective
        if ($request->tag === 'elective' && !empty($validatedData['program_ids'])) {
            $subject->programs()->sync($validatedData['program_ids']);
        } else {
            // Detach all programs if the tag is not elective or no programs are selected
            $subject->programs()->detach();
        }

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }




    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
