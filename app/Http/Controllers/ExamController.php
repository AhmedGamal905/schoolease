<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $exams = Exam::query()
            ->whereRelation('lesson', 'user_id', $userId)
            ->with('lesson')
            ->latest()
            ->paginate();

        return view('exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lessons = $this->getUserLessons();

        return view('exams.create', compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'lesson' => ['required', 'exists:lessons,id', 'unique:exams,lesson_id'],
        ]);

        Exam::create([
            'description' => $request->description,
            'lesson_id' => $request->lesson,
        ]);

        session()->flash('success', 'Exam created successfully!');

        return to_route('exams.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $lessons = $this->getUserLessons();

        return view('exams.edit', compact(['exam', 'lessons']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {

        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'lesson' => ['required', 'exists:lessons,id', 'unique:exams,lesson_id,'.$exam->id],
        ]);

        $exam->update([
            'description' => $request->description,
            'lesson_id' => $request->lesson,
        ]);

        session()->flash('success', 'Exam was updated successfully!');

        return to_route('exams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        session()->flash('success', 'Exam was cancelled successfully!');

        return to_route('exams.index');
    }

    /**
     * Retrieve lessons for the authenticated user(teacher).
     */
    private function getUserLessons()
    {
        $userId = auth()->user()->id;

        return Lesson::query()
            ->where('user_id', $userId)
            ->where('time', '>=', Carbon::today())
            ->with('subject')
            ->orderBy('time', 'asc')
            ->get();
    }
}
