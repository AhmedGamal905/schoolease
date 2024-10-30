<?php

use App\Models\Lesson;
use App\Models\Subject;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->teacher = User::factory()->withTeacherRole();

    $this->actingAs($this->teacher);
});

test('teacher can view lessons', function () {
    $this->get(route('lessons.index'))
        ->assertStatus(200)
        ->assertViewIs('lessons.index')
        ->assertViewHas('lessons');
});

test('teacher can view create', function () {
    $this->get(route('lessons.create'))
        ->assertStatus(200)
        ->assertViewIs('lessons.create');
});

test('teacher can destroy lessons', function () {
    $lesson = Lesson::factory()->create(
        [
            'time' => now()->addDays(random_int(5, 10)),
            'duration' => 30,
            'subject_id' => Subject::factory()->create()->id,
            'user_id' => $this->teacher->id,
        ]
    );
    $this->delete(route('lessons.destroy', $lesson))
        ->assertStatus(302)
        ->assertRedirect(route('lessons.index'));

    $this->assertDatabaseMissing('lessons', ['id' => $lesson->id]);
});