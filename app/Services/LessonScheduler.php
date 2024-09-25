<?php

namespace App\Services;

use Carbon\Carbon;

class LessonScheduler
{
    public static function isLessonOverlapping($dateTime, $duration, $existingLessons)
    {
        $endTime = $dateTime->copy()->addMinutes((int) $duration);

        foreach ($existingLessons as $lesson) {
            $lessonStart = Carbon::parse($lesson->time);
            $lessonEnd = $lessonStart->copy()->addMinutes($lesson->duration);
            if (
                $dateTime->between($lessonStart, $lessonEnd) ||
                $endTime->between($lessonStart, $lessonEnd)
            ) {
                return true;
            }
        }

        return false;
    }
}
