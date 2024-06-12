<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\Level;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminProgramController extends Controller
{
    public function create()
    {
        $exams = ExamType::all();
        $levels = Level::all();

        return view('programs.create', compact('exams', 'levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_id' => 'required|exists:levels,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'name' => 'required|string|max:255',
        ]);
        $data = $request->except(['_token']);

        $programExist = Program::where('level_id', $request->level_id)->where('exam_type_id', $request->exam_type_id)->where('name', $request->name)->first();
        if (!$programExist == null) {
            return redirect()->back()->with('error', 'Program is already in the system for this level and exam type.');
        }
        Program::create($data);

        return redirect()->back()->with('success', 'Program created successfully.');
    }

    public function edit(Program $program)
    {
        $levels = Level::all();
        return view('programs.edit', compact('program', 'levels'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'level_id' => 'required|exists:levels,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'name' => 'required|string|max:255',
        ]);

        $program->update($request->all());

        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')->with('success', 'Subject deleted successfully.');
    }

    public function getPrograms(Request $request)
    {
        Log::info($request->all());
        $levelId = $request->input('level_id');
        $examTypeId = $request->input('exam_type_id');
        $tag = $request->input('tag');

        if ($tag !== 'elective') {
            return response()->json(['error' => 'Invalid tag'], 400);
        }

        // Query the database for programs that match level_id and exam_type_id
        $programs = Program::where('level_id', $levelId)
            ->where('exam_type_id', $examTypeId)
            ->get();

        return response()->json($programs);
    }
}
