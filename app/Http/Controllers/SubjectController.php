<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::query()
            ->latest()
            ->paginate();

        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20', 'unique:subjects,name', 'lowercase'],
        ]);

        Subject::create(['name' => $request->name]);

        session()->flash('success', 'Subject was created successfully!');

        return to_route('subjects.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20', 'unique:subjects,name,' . $subject->id, 'lowercase'],
        ]);

        $subject->update(['name' => $request->name]);

        session()->flash('success', 'Subject was updated successfully!');

        return to_route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        session()->flash('success', 'Subject was deleted successfully!');

        return to_route('subjects.index');
    }
}
