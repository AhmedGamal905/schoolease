<?php

use App\Models\Exam;
use App\Models\Lesson;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->teacher = User::factory()->withTeacherRole();

    $this->actingAs($this->teacher);
});

test('teacher can view exams', function () {
    $this->get(route('exams.index'))
        ->assertStatus(200)
        ->assertViewIs('exams.index')
        ->assertViewHas('exams');
});

test('teacher can view create', function () {
    $this->get(route('exams.create'))
        ->assertStatus(200)
        ->assertViewIs('exams.create')
        ->assertViewHas('lessons');
});

test('teacher can store exams', function () {
    $data = [
        'description' => fake()->text(50),
        'lesson' => Lesson::factory()->create()->id,
    ];

    $this->post(route('exams.store'), $data)
        ->assertStatus(302)
        ->assertSessionHas('success')
        ->assertRedirect(route('exams.index'));
});

test('store method validation', function () {
    $data = [
        'description' => '',
        'lesson' => Lesson::factory()->create()->id,
    ];

    $this->post(route('exams.store'), $data)
        ->assertStatus(302)
        ->assertSessionHasErrors('description');

    $data = [
        'description' => fake()->text(50),
        'lesson' => '',
    ];

    $this->post(route('exams.store'), $data)
        ->assertStatus(302)
        ->assertSessionHasErrors('lesson');
});

test('teacher can view edit', function () {
    $exam = Exam::factory()->create();

    $this->get(route('exams.edit', $exam))
        ->assertStatus(200)
        ->assertViewIs('exams.edit')
        ->assertViewHas(['exam', 'lessons']);
});

test('teacher can update exam', function () {
    $exam = Exam::factory()->create([
        'description' => 'Old Description',
        'lesson_id' => Lesson::factory()->create()->id,
    ]);

    $newData = [
        'description' => 'New Description',
        'lesson' => Lesson::factory()->create()->id,
    ];

    $this->put(route('exams.update', $exam), $newData)
        ->assertStatus(302)
        ->assertSessionHas('success')
        ->assertRedirect(route('exams.index'));

    $this->assertDatabaseHas('exams', [
        'id' => $exam->id,
        'description' => 'New Description',
        'lesson_id' => $newData['lesson'],
    ]);
});

test('update method validation', function () {
    $exam = Exam::factory()->create();

    $invalidData = [
        'description' => '',
        'lesson' => Lesson::factory()->create()->id,
    ];

    $this->put(route('exams.update', $exam), $invalidData)
        ->assertStatus(302)
        ->assertSessionHasErrors('description');

    $invalidData = [
        'description' => 'Valid Description',
        'lesson' => '',
    ];

    $this->put(route('exams.update', $exam), $invalidData)
        ->assertStatus(302)
        ->assertSessionHasErrors('lesson');
});

test('teacher can destroy exam', function () {
    $exam = Exam::factory()->create();

    $this->delete(route('exams.destroy', $exam))
        ->assertStatus(302)
        ->assertSessionHas('success')
        ->assertRedirect(route('exams.index'));

    $this->assertDatabaseMissing('exams', [
        'id' => $exam->id,
    ]);
});