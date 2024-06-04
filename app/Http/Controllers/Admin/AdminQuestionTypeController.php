<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionType;
use Illuminate\Http\Request;

class AdminQuestionTypeController extends Controller
{
    public function index()
    {
        $types = QuestionType::all();
        return view('types.index', compact('types'));
    }


    public function create()
    {
        return view('types.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        QuestionType::create($request->all());

        return redirect()->back()->with('success', 'Question Type created successfully.');
    }


    public function edit(QuestionType $QuestionType)
    {
        return view('types.edit', compact('QuestionType'));
    }

    public function update(Request $request, QuestionType $QuestionType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $QuestionType->update($request->all());

        return redirect()->route('question_type')->with('success', 'Question Type updated successfully.');
    }

    public function destroy(QuestionType $QuestionType)
    {
        $QuestionType->delete();

        return redirect()->route('question_type')->with('success', 'Question Type deleted successfully.');
    }
}
