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
            'grades.*.grade' => ['required', 'integer', 'min:0', 'max:5'],
            'grades.*.user_id' => ['required', 'exists:users,id'],
        ]);

        $grades = collect($request->grades)->map(function ($grade) use ($exam) {
            return [
                'exam_id' => $exam->id,
                'user_id' => $grade['user_id'],
                'grade' => (int) $grade['grade'],
            ];
        })->toArray();

        Grade::upsert($grades, ['exam_id', 'user_id'], ['grade', 'updated_at']);

        session()->flash('success', 'Grades saved successfully!');

        return to_route('exams.index');
    }
}
