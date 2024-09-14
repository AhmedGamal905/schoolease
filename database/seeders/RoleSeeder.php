<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'super-admin']);

        Role::create(['name' => 'teacher']);

        Role::create(['name' => 'user']);

        $admin->givePermissionTo(['super-admin']);
    }
}
