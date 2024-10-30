<?php

use App\Models\Classroom;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->classroom = Classroom::factory()->create();

    $this->student = User::factory()->withUserRole();

    $this->actingAs($this->student);
});

test('student can view lessons', function () {
    $this->student->update(
        [
            'classroom_id' => $this->classroom->id,
        ]
    );

    $this->get(route('overview.lessons'))
        ->assertStatus(200)
        ->assertViewIs('student.lessons')
        ->assertViewHas('lessons');
});

test('student can view exams', function () {
    $this->student->update(
        [
            'classroom_id' => $this->classroom->id,
        ]
    );

    $this->get(route('overview.exams'))
        ->assertStatus(200)
        ->assertViewIs('student.exams')
        ->assertViewHas('lessonExams')
        ->assertViewHas('user', $this->student);
});

test('student without classroom cannot view lessons', function () {
    $this->get(route('overview.lessons'))
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('error');
});

test('student without classroom cannot view exams', function () {
    $this->get(route('overview.exams'))
        ->assertRedirect(route('dashboard'))
        ->assertSessionHas('error');
});