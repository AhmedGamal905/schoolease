<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = Lesson::all();

        foreach ($lessons as $lesson) {
            Exam::create([
                'description' => 'Sample Exam for '.$lesson->id,
                'lesson_id' => $lesson->id,
            ]);
        }
    }
}
