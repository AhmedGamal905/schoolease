<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'time' => now()->addDays(random_int(5, 10)),
            'duration' => 30,
            'subject_id' => Subject::factory()->create()->id,
            'user_id' => User::factory()->withTeacherRole()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Lesson $lesson) {
            $classroom = Classroom::factory()->create();
            $lesson->classrooms()->attach($classroom->id);
        });
    }
}
