<?php

use App\Models\Classroom;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->withAdminRole();

    $this->user = User::factory()->withUserRole();

    $this->actingAs($this->admin);
});

test('admin can view students classrooms', function () {
    $this->get(route('students.index'))
        ->assertStatus(200)
        ->assertViewIs('students.index')
        ->assertViewHas('users')
        ->assertViewHas('classrooms');
});

test('admin can assign classroom students', function () {
    $classroom = Classroom::factory()->create();

    $this->post(route('students.update', $this->user), [
        'classroom_id' => $classroom->id,
    ])
        ->assertStatus(302)
        ->assertSessionHas('success')
        ->assertRedirect(route('students.index'));
});