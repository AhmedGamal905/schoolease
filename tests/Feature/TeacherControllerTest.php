<?php

use App\Models\Subject;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->teacher = User::factory()->withTeacherRole();

    $this->admin = User::factory()->withAdminRole();

    $this->actingAs($this->admin);
});

test('admin can view teachers with subjects', function () {
    $this->get(route('teachers.index'))
        ->assertStatus(200)
        ->assertViewIs('teachers.index')
        ->assertViewHas('users', function ($users) {
            return $users->contains($this->teacher);
        })
        ->assertViewHas('subjects');
});

test('admin can toggle subject assignment', function () {
    $subject = Subject::factory()->create();

    // Attach the subject to the teacher
    $this->post(route('subject.toggle', ['user' => $this->teacher->id, 'subject' => $subject->id]))
        ->assertStatus(302)
        ->assertRedirect(route('teachers.index'));

    $this->assertDatabaseHas('subject_user', [
        'user_id' => $this->teacher->id,
        'subject_id' => $subject->id,
    ]);

    // Detach the subject from the teacher
    $this->post(route('subject.toggle', ['user' => $this->teacher->id, 'subject' => $subject->id]))
        ->assertStatus(302)
        ->assertRedirect(route('teachers.index'));

    $this->assertDatabaseMissing('subject_user', [
        'user_id' => $this->teacher->id,
        'subject_id' => $subject->id,
    ]);
});