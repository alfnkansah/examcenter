<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use App\Models\ExamType;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ExamCategroyController extends Controller
{
    public function create()
    {
        $levels = Level::all();
        $examtype = ExamType::all();
        return view('category.create', compact('levels', 'examtype'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level_id' => 'required|exists:levels,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $level = Level::where('id', $request->level_id)->first();
        if (!$level) {
            return redirect()->back()->with('error', 'Invalid Level');
        }

        $exam = ExamType::where('id', $request->exam_type_id)->first();
        if (!$exam) {
            return redirect()->back()->with('error', 'Invalid Exam Type');
        }

        // Validation passed, save the record
        $category = new ExamCategory();
        $category->level_id = $request->level_id;
        $category->exam_type_id = $request->exam_type_id;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->route('category.index')->with('success', 'Exam type created successfully.');
    }


    public function getExamType(Request $request)
    {
        $levelId = $request->input('level_id');

        $subjects = ExamType::where('level_id', $levelId)
            ->get();

        return response()->json($subjects);
    }

    public function edit(ExamCategory $examCat)
    {
        $levels = Level::all();
        $examtype = ExamType::all();
        return view('category.edit', compact('examCat', 'levels', 'examtype'));
    }

    public function update(Request $request, ExamCategory $examCat)
    {
        $request->validate([
            'level_id' => 'required',
            'exam_type_id' => 'required',
            'name' => 'required|string|max:255',
        ]);

        $examCat->update([
            'level_id' => $request->level_id,
            'exam_type_id' => $request->exam_type_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('category.index')->with('success', 'Exam Category updated successfully.');
    }




    public function destroy(ExamCategory $examCat)
    {
        $examCat->delete();

        return redirect()->route('category.index')->with('success', 'Exam Category deleted successfully.');
    }
}
