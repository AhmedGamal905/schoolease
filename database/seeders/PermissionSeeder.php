<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'super-admin']);
        Permission::create(['name' => 'teacher']);
        Permission::create(['name' => 'user']);
    }
}
