<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::create(['name' => 'math']);
        Subject::create(['name' => 'english']);
        Subject::create(['name' => 'arabic']);
        Subject::create(['name' => 'science']);
    }
}
