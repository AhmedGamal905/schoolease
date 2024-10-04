<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
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

        return view('attendance.index', compact('lessons'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        $classroomId = $lesson->load('classrooms')->classrooms->first()->id;

        $users = User::whereHas('classroom', fn ($query) => $query->where('id', $classroomId))
            ->with(['attendances' => fn ($query) => $query->where('lesson_id', $lesson->id)])
            ->get();

        return view('attendance.show', compact(['users', 'lesson']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Lesson $lesson)
    {
        $request->validate([
            'attendance' => ['required', 'array'],
            'attendance.*.status' => ['boolean'],
            'attendance.*.user_id' => ['exists:users,id'],
        ]);

        $attendance = collect($request->attendance)->map(function ($status, $userId) use ($lesson) {
            return [
                'lesson_id' => $lesson->id,
                'user_id' => $userId,
                'status' => (bool) $status,
            ];
        })->toArray();

        Attendance::upsert($attendance, ['lesson_id', 'user_id'], ['status', 'updated_at']);

        session()->flash('success', 'Attendance saved successfully!');

        return to_route('attendance.index');
    }
}
