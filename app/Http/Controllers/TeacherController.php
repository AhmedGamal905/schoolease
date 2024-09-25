<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with('subjects')
            ->role('teacher')
            ->paginate();

        $subjects = Subject::all();

        return view('teachers.index', compact(['users', 'subjects']));
    }

    public function toggleAssignment(User $user, Subject $subject)
    {
        if ($user->subjects()->where('subject_id', $subject->id)->exists()) {

            $user->subjects()->detach($subject->id);

            session()->flash('success', 'Subject detached successfully!');

            return to_route('teachers.index');
        } else {

            $user->subjects()->attach($subject->id);

            session()->flash('success', 'Subject assigned successfully!');

            return to_route('teachers.index');
        }
    }
}
