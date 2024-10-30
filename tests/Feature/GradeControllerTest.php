<?php

use App\Models\Classroom;
use App\Models\Exam;
use App\Models\Lesson;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->teacher = User::factory()->withTeacherRole();

    $this->actingAs($this->teacher);

    $this->classroom = Classroom::factory()->create();

    $this->lesson = Lesson::factory()->create([
        'user_id' => $this->teacher->id,
    ]);

    $this->exam = Exam::factory()->create([
        'description' => 'test exam',
        'lesson_id' => $this->lesson->id,
    ]);

    $this->student = User::factory()->withUserRole();
});

test('teacher show grades for exam', function () {
    $this->get(route('grade.show', $this->exam))
        ->assertStatus(200)
        ->assertViewIs('grade.show')
        ->assertViewHas(['users', 'exam']);
});

test('teacher can store grades for exam', function () {
    $grades = [
        ['user_id' => $this->student->id, 'grade' => 4],
    ];

    $this->post(route('grade.store', $this->exam), ['grades' => $grades])
        ->assertRedirect(route('exams.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('grades', [
        'exam_id' => $this->exam->id,
        'user_id' => $this->student->id,
        'grade' => 4,
    ]);
});