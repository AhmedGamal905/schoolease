<?php

use App\Models\User;
use Database\Factories\RoleFactory;
use Spatie\Permission\Models\Permission;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->withAdminRole();

    $this->actingAs($this->admin);
});

test('admin can view permissions', function () {
    $this->get(route('permissions.index'))
        ->assertStatus(200)
        ->assertViewIs('permissions.index')
        ->assertViewHas('permissions');
});

test('admin can view create with roles', function () {
    $this->get(route('permissions.create'))
        ->assertStatus(200)
        ->assertViewIs('permissions.create')
        ->assertViewHas('roles');
});

test('admin can create new permission', function () {
    $role = RoleFactory::new()->create(['name' => 'testrole']);

    $data = [
        'name' => 'newpermission',
        'role_ids' => $role->pluck('id')->toArray(),
    ];

    $this->post(route('permissions.store'), $data)
        ->assertStatus(302)
        ->assertRedirect(route('permissions.index'));

    $this->assertDatabaseHas('permissions', ['name' => 'newpermission']);

    $this->assertDatabaseHas('role_has_permissions', [
        'role_id' => $role->id,
        'permission_id' => Permission::where('name', 'newpermission')->first()->id,
    ]);
});

test('store method validation', function () {
    $data = [
        'name' => '',
        'role_ids' => [],
    ];

    $this->post(route('permissions.store'), $data)
        ->assertSessionHasErrors(['name', 'role_ids']);
});

test('edit method displays edit form', function () {
    $permission = Permission::create(['name' => 'testpermission']);

    $this->get(route('permissions.edit', $permission))
        ->assertStatus(200)
        ->assertViewIs('permissions.edit')
        ->assertViewHas('permission', $permission);
});

test('update method updates permission', function () {
    $permission = Permission::create(['name' => 'oldpermission']);

    $data = [
        'name' => 'newpermission',
    ];

    $this->put(route('permissions.update', $permission), $data)
        ->assertStatus(302)
        ->assertRedirect(route('permissions.index'));

    $this->assertDatabaseHas('permissions', ['id' => $permission->id, 'name' => 'newpermission']);
});

test('update method validation', function () {
    $permission = Permission::create(['name' => 'oldpermission']);

    $data = [
        'name' => '',
    ];

    $this->put(route('permissions.update', $permission), $data)
        ->assertSessionHasErrors(['name']);
});

test('admin can destroy permission', function () {
    $permission = Permission::create(['name' => 'testpermission']);

    $this->delete(route('permissions.destroy', $permission))
        ->assertStatus(302)
        ->assertRedirect(route('permissions.index'));

    $this->assertDatabaseMissing('permissions', ['id' => $permission->id, 'name' => 'testpermission']);
});