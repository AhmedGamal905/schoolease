<?php

use App\Models\Subject;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->withAdminRole();

    $this->actingAs($this->admin);
});

test('admin can view subjects', function () {
    $this->get(route('subjects.index'))
        ->assertStatus(200)
        ->assertViewIs('subjects.index')
        ->assertViewHas('subjects');
});

test('admin can view create', function () {
    $this->get(route('subjects.create'))
        ->assertStatus(200)
        ->assertViewIs('subjects.create');
});

test('admin can create new subject', function () {
    $data = [
        'name' => 'english',
    ];

    $this->post(route('subjects.store'), $data)
        ->assertStatus(302)
        ->assertRedirect(route('subjects.index'));

    $this->assertDatabaseHas('subjects', ['name' => 'english']);
});

test('store method validation', function () {
    $data = [
        'name' => '',
    ];

    $this->post(route('subjects.store'), $data)
        ->assertSessionHasErrors(['name']);
});

test('edit method displays edit form', function () {
    $subject = Subject::create(['name' => 'testsubject']);

    $this->get(route('subjects.edit', $subject))
        ->assertStatus(200)
        ->assertViewIs('subjects.edit')
        ->assertViewHas('subject', $subject);
});

test('update method updates subject', function () {
    $subject = Subject::create(['name' => 'oldsubject']);

    $newSubject = [
        'name' => 'newsubject',
    ];

    $this->put(route('subjects.update', $subject), $newSubject)
        ->assertStatus(302)
        ->assertRedirect(route('subjects.index'));

    $this->assertDatabaseHas('subjects', ['name' => 'newsubject']);
});

test('update method validation', function () {
    $subject = Subject::create(['name' => 'oldsubjects']);

    $data = [
        'name' => '',
    ];

    $this->put(route('subjects.update', $subject), $data)
        ->assertSessionHasErrors(['name']);
});

test('admin can destroy subject', function () {
    $subject = Subject::create(['name' => '23ED']);

    $this->delete(route('subjects.destroy', $subject))
        ->assertStatus(302)
        ->assertRedirect(route('subjects.index'));

    $this->assertDatabaseMissing('subjects', ['id' => $subject->id, 'name' => $subject->name]);
});