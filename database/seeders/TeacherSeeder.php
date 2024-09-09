<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'teacher',
            'email' => 'teacher@teacher.com',
            'password' => 'teacher@teacher.com',
        ])->assignRole('teacher');;
    }
}
