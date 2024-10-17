<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['time', 'duration', 'subject_id', 'user_id'];

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_lesson');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'lesson_user');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
