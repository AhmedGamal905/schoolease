<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classroom = Classroom::create([
            'name' => '2EB',
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('user@user.com'),
            'classroom_id' => $classroom->id,
        ])->assignRole('user');
    }
}
