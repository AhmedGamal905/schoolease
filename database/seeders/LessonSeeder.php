<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::create([
            'name' => 'teacher1',
            'email' => 'teacher1@teacher.com',
            'password' => bcrypt('teacher1@teacher.com'),
        ])->assignRole('teacher');

        $subject = Subject::create(['name' => 'ai']);

        $classroom = Classroom::create(['name' => '5ABC']);

        $lessonsData = [
            [
                'time' => Carbon::now()->addDays(3),
                'duration' => 30,
                'subject_id' => $subject->id,
                'user_id' => $teacher->id,
            ],
            [
                'time' => Carbon::now()->addDays(4),
                'duration' => 30,
                'subject_id' => $subject->id,
                'user_id' => $teacher->id,
            ],
            [
                'time' => Carbon::now()->addDays(5),
                'duration' => 30,
                'subject_id' => $subject->id,
                'user_id' => $teacher->id,
            ],
        ];

        foreach ($lessonsData as $lessonData) {
            $lesson = Lesson::create($lessonData);
            $lesson->classrooms()->attach($classroom->id);
        }
    }
}
