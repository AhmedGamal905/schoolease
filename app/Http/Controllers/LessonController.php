<?php

namespace App\Http\Controllers;

use App\Models\Lesson;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $lessons = Lesson::query()
            ->where('user_id', $userId)
            ->with(['subject', 'classrooms'])
            ->latest()
            ->paginate();

        return view('lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lessons.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        session()->flash('success', 'Lesson was deleted successfully!');

        return to_route('lessons.index');
    }
}
