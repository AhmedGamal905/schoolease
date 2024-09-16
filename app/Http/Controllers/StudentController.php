<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->with('classroom')
            ->role('user')
            ->paginate();

        $classrooms = Classroom::all();

        return view('students.index', compact(['users', 'classrooms']));
    }

    /**
     * Update the specified resource in storage.
     * Assign a classroom to a student
     */
    public function assignClass(Request $request, User $user)
    {
        $request->validate([
            'classroom_id' => ['required', 'exists:classrooms,id'],
        ]);

        $user->update(['classroom_id' => $request->classroom_id]);

        session()->flash('success', 'Class was assigned to a student!');

        return to_route('students.index');
    }
}
