<?php

namespace App\Livewire;

use App\Models\Classroom;
use App\Models\Lesson;
use App\Services\LessonScheduler;
use Carbon\Carbon;
use Livewire\Component;

class LessonsCalendar extends Component
{
    public $date;

    public $classrooms;

    public $subjects;

    public $time;

    public $classroom;

    public $subject;

    public $duration;

    public $lessons = [];

    public function mount()
    {
        $this->classrooms = Classroom::all();

        $this->subjects = auth()->user()->load('subjects')->subjects;
    }

    public function render()
    {

        if ($this->classroom && $this->date) {
            $this->lessons = Lesson::query()
                ->whereDate('time', $this->date)
                ->whereHas('classrooms', function ($query) {
                    $query->where('classroom_id', $this->classroom);
                })
                ->with('subject')
                ->get();
        }

        return view('livewire.lessons-calendar', [
            'lessons' => $this->lessons,
            'classrooms' => $this->classrooms,
            'subjects' => $this->subjects,
        ]);
    }

    public function createLesson()
    {
        $this->validate([
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
            'classroom' => ['required', 'exists:classrooms,id'],
            'subject' => ['required', 'exists:subjects,id'],
            'duration' => ['required', 'integer'],
        ]);

        $dateTime = Carbon::createFromFormat('Y-m-d H:i', $this->date.' '.$this->time);

        if (LessonScheduler::isLessonOverlapping($dateTime, $this->duration, $this->lessons)) {
            $this->addError('time', 'The lesson time overlaps with an existing lesson.');

            return;
        }

        $lesson = Lesson::create([
            'time' => $dateTime,
            'duration' => $this->duration,
            'subject_id' => $this->subject,
            'user_id' => auth()->user()->id,
        ]);

        $lesson->classrooms()->attach($this->classroom);

        session()->flash('success', 'Lesson created successfully!');

        return to_route('lessons.index');
    }
}
