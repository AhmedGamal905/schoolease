<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->withAdminRole();

    $this->actingAs($this->admin);
});

test('admin can view roles', function () {
    $this->get(route('roles.index'))
        ->assertStatus(200)
        ->assertViewIs('roles.index')
        ->assertViewHas('roles');
});

test('admin can view create', function () {
    $this->get(route('roles.create'))
        ->assertStatus(200)
        ->assertViewIs('roles.create');
});

test('admin can create new role', function () {
    $data = [
        'name' => 'testrole',
    ];

    $this->post(route('roles.store'), $data)
        ->assertStatus(302)
        ->assertRedirect(route('roles.index'));

    $this->assertDatabaseHas('roles', ['name' => 'testrole']);
});

test('store method validation', function () {
    $data = [
        'name' => '',
    ];

    $this->post(route('roles.store'), $data)
        ->assertSessionHasErrors(['name']);
});

test('edit method displays edit form', function () {
    $role = Role::create(['name' => 'testrole']);

    $this->get(route('roles.edit', $role))
        ->assertStatus(200)
        ->assertViewIs('roles.edit')
        ->assertViewHas('role', $role);
});

test('update method updates role', function () {
    $role = Role::create(['name' => 'oldrole']);

    $data = [
        'name' => 'newrole',
    ];

    $this->put(route('roles.update', $role), $data)
        ->assertStatus(302)
        ->assertRedirect(route('roles.index'));

    $this->assertDatabaseHas('roles', ['id' => $role->id, 'name' => 'newrole']);
});

test('update method validation', function () {
    $role = Role::create(['name' => 'oldrole']);

    $data = [
        'name' => '',
    ];

    $this->put(route('roles.update', $role), $data)
        ->assertSessionHasErrors(['name']);
});

test('admin can destroy role', function () {
    $role = Role::create(['name' => 'newrole']);

    $this->delete(route('roles.destroy', $role))
        ->assertStatus(302)
        ->assertRedirect(route('roles.index'));

    $this->assertDatabaseMissing('roles', ['id' => $role->id, 'name' => $role->name]);
});