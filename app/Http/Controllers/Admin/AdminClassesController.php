<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class AdminClassesController extends Controller
{
    public function create()
    {
        return view('level.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Level::create($request->all());

        return redirect()->back()->with('success', 'Level created successfully.');
    }

    public function edit(Level $level)
    {
        return view('level.edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $level->update($request->all());

        return redirect()->route('levels.index')->with('success', 'Level updated successfully.');
    }

    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('levels.index')->with('success', 'Level deleted successfully.');
    }
}
