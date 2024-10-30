<?php

use App\Models\Lesson;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->teacher = User::factory()->withTeacherRole();

    $this->actingAs($this->teacher);

    $this->lesson = Lesson::factory()->create();
});

test('teacher can view attendance', function () {
    $this->get(route('attendance.index'))
        ->assertStatus(200)
        ->assertViewIs('attendance.index')
        ->assertViewHas('lessons');
});

test('teacher can view lessons attendance', function () {
    $this->get(route('attendance.show', $this->lesson))
        ->assertStatus(200)
        ->assertViewIs('attendance.show')
        ->assertViewHas(['users', 'lesson']);
});

test('teacher can store attendance', function () {
    $students = User::factory()->count(3)->create();

    $attendanceData = $students->mapWithKeys(function ($student) {
        return [$student->id => ['status' => true]];
    })->toArray();

    $this->post(route('attendance.store', $this->lesson), [
        'attendance' => $attendanceData,
    ])
        ->assertRedirect(route('attendance.index'))
        ->assertSessionHas('success');

    foreach ($students as $student) {
        $this->assertDatabaseHas('attendances', [
            'lesson_id' => $this->lesson->id,
            'user_id' => $student->id,
            'status' => true,
        ]);
    }
});