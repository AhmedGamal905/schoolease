<?php

use App\Livewire\LessonsCalendar;
use App\Models\Classroom;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->teacher = User::factory()->withTeacherRole();

    $this->actingAs($this->teacher);

    $this->subject = Subject::factory()->create()->id;

    $this->date = now()->addDays(1)->format('Y-m-d');

    $this->time = now()->addHours(random_int(1, 5))->format('H:i');

    $this->duration = 30;

    $this->classroom = Classroom::factory()->create()->id;
});

test('teacher can create lesson', function () {
    Livewire::test(LessonsCalendar::class)
        ->set('date', $this->date)
        ->set('time', $this->time)
        ->set('duration', $this->duration)
        ->set('classroom', $this->classroom)
        ->set('subject', $this->subject)
        ->call('createLesson')
        ->assertHasNoErrors()
        ->assertSessionHas('success')
        ->assertRedirect(route('lessons.index'));

    $this->assertDatabaseHas('lessons', [
        'time' => Carbon::createFromFormat('Y-m-d H:i', $this->date.' '.$this->time),
        'duration' => $this->duration,
        'subject_id' => $this->subject,
        'user_id' => $this->teacher->id,
    ]);
});

test('lesson overlap detection', function () {
    $existingLesson = Lesson::create([
        'time' => Carbon::createFromFormat('Y-m-d H:i', $this->date.' '.$this->time),
        'duration' => $this->duration,
        'subject_id' => $this->subject,
        'user_id' => $this->teacher->id,
    ]);

    $existingLesson->classrooms()->attach($this->classroom);

    Livewire::test(LessonsCalendar::class)
        ->set('date', $existingLesson->time->format('Y-m-d'))
        ->set('time', $existingLesson->time->format('H:i'))
        ->set('duration', $this->duration)
        ->set('classroom', $this->classroom)
        ->set('subject', $this->subject)
        ->call('createLesson')
        ->assertHasErrors(['time' => 'The lesson time overlaps with an existing lesson.']);
});