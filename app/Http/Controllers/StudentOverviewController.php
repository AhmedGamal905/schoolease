<?php

namespace App\Http\Controllers;

class StudentOverviewController extends Controller
{
    public function lessons()
    {

        $user = auth()->user();

        $userClassroom = $user->classroom;

        $lessons = $userClassroom->lessons()
            ->with([
                'subject',
                'teacher',
                'attendances' => function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                },
            ])
            ->latest()
            ->paginate();

        return view('student.lessons', compact('lessons'));
    }

    public function exams()
    {
        $user = auth()->user();

        $classroom = $user->classroom;

        $lessonExams = $classroom->lessons()
            ->with([
                'exams.grades' => function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                },
                'subject',
                'teacher',
            ])
            ->latest()
            ->paginate();

        return view('student.exams', compact('lessonExams', 'user'));
    }
}
