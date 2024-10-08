<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        $users = $exam->lesson->classrooms()->with([
            'users.grades' => function ($query) use ($exam) {
                $query->where('exam_id', $exam->id);
            },
        ])->first()->users;

        return view('grade.show', compact(['users', 'exam']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Exam $exam)
    {
        $request->validate([
            'grades' => ['required', 'array'],
            'grades.*' => ['required', 'integer', 'min:0', 'max:5'],
            'grades.*.user_id' => ['exists:users,id'],
        ]);

        $grade = collect($request->grades)->map(function ($grade, $userId) use ($exam) {
            return [
                'exam_id' => $exam->id,
                'user_id' => $userId,
                'grade' => (int) $grade,
            ];
        })->toArray();

        Grade::upsert($grade, ['exam_id', 'user_id'], ['grade', 'updated_at']);

        session()->flash('success', 'Attendance saved successfully!');

        return to_route('exams.index');
    }
}
