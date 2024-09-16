<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::query()
            ->latest()
            ->paginate();

        return view('classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:10', 'unique:classrooms,name'],
        ]);

        Classroom::create(['name' => $request->name]);

        session()->flash('success', 'Classroom was created successfully!');

        return to_route('classrooms.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:10', 'unique:classrooms,name'],
        ]);

        $classroom->update(['name' => $request->name]);

        session()->flash('success', 'Classroom was updated successfully!');

        return to_route('classrooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        session()->flash('success', 'Classroom was deleted successfully!');

        return to_route('classrooms.index');
    }
}
