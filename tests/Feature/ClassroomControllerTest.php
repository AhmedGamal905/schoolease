<?php

use App\Models\Classroom;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->withAdminRole();

    $this->actingAs($this->admin);
});

test('admin can view classrooms', function () {
    $this->get(route('classrooms.index'))
        ->assertStatus(200)
        ->assertViewIs('classrooms.index')
        ->assertViewHas('classrooms');
});

test('admin can view create', function () {
    $this->get(route('classrooms.create'))
        ->assertStatus(200)
        ->assertViewIs('classrooms.create');
});

test('admin can create new classroom', function () {
    $data = [
        'name' => '1EB',
    ];

    $this->post(route('classrooms.store'), $data)
        ->assertStatus(302)
        ->assertRedirect(route('classrooms.index'));

    $this->assertDatabaseHas('classrooms', ['name' => '1EB']);
});

test('store method validation', function () {
    $data = [
        'name' => '',
    ];

    $this->post(route('classrooms.store'), $data)
        ->assertSessionHasErrors(['name']);
});

test('edit method displays edit form', function () {
    $classroom = Classroom::create(['name' => 'testclassroom']);

    $this->get(route('classrooms.edit', $classroom))
        ->assertStatus(200)
        ->assertViewIs('classrooms.edit')
        ->assertViewHas('classroom', $classroom);
});

test('update method updates classroom', function () {
    $classroom = Classroom::create(['name' => 'oldclassroom']);

    $newClassroom = [
        'name' => 'newclsroom',
    ];

    $this->put(route('classrooms.update', $classroom), $newClassroom)
        ->assertStatus(302)
        ->assertRedirect(route('classrooms.index'));

    $this->assertDatabaseHas('classrooms', ['name' => 'newclsroom']);
});

test('update method validation', function () {
    $classroom = Classroom::create(['name' => 'oldclassroom']);

    $data = [
        'name' => '',
    ];

    $this->put(route('classrooms.update', $classroom), $data)
        ->assertSessionHasErrors(['name']);
});

test('admin can destroy classroom', function () {
    $classroom = Classroom::create(['name' => '23ED']);

    $this->delete(route('classrooms.destroy', $classroom))
        ->assertStatus(302)
        ->assertRedirect(route('classrooms.index'));

    $this->assertDatabaseMissing('classrooms', ['id' => $classroom->id, 'name' => $classroom->name]);
});