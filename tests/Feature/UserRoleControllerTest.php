<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->withAdminRole();

    $this->role = Role::create(['name' => 'teacher']);

    $this->user = User::factory()->create();

    $this->actingAs($this->admin);
});

test('admin can view users and roles', function () {
    $this->get(route('user-roles.index'))
        ->assertStatus(200)
        ->assertViewIs('users.index')
        ->assertViewHas(['users', 'roles']);
});

test('admin can assign user role', function () {
    $this->post(route('user-roles.store', ['user' => $this->user]), [
        'role' => $this->role->name,
    ])
        ->assertStatus(302)
        ->assertRedirect(route('user-roles.index'))
        ->assertSessionHas('success');

    expect($this->user->hasRole($this->role->name))->toBeTrue();
});

test('admin can reset user role', function () {
    $this->user->assignRole('teacher');

    $this->put(route('user-roles.update', ['user' => $this->user]))
        ->assertStatus(302)
        ->assertRedirect(route('user-roles.index'))
        ->assertSessionHas('success');

    expect($this->user->roles->isEmpty())->toBeTrue();
});