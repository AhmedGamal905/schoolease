<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->with('roles')
            ->latest()
            ->paginate();

        $roles = Role::all();

        return view('users.index', compact(['users', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     * Assign roles
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'exists:roles,name'],
        ]);

        $user->assignRole($request->role);

        session()->flash('success', 'Role Assigned successfully!');

        return to_route('user-roles.index');
    }

    /**
     * Update the specified resource in storage.
     * Roles reset for user
     */
    public function update(Request $request, User $user)
    {
        $user->syncRoles([]);

        session()->flash('success', 'Roles Rested successfully!');

        return to_route('user-roles.index');
    }
}
