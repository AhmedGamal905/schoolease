@extends('layouts.dashboard')
@section('content')

@forelse ($lessonExams as $lesson)
<div class="p-4 sm:p-5 bg-white border border-stone-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
    <div class="sm:order-1 grow space-y-1">
        <h2 class="text-lg md:text-xl font-semibold text-stone-800 dark:text-neutral-200">
            Teacher: {{ $lesson->teacher->name }} - Subject: {{ $lesson->subject->name }}
        </h2>
        <h2 class="text-lg md:text-xl font-semibold text-stone-800 dark:text-neutral-200">
            Time: {{ $lesson->time }} - Duration: {{ $lesson->duration }} Minutes
        </h2>
        @foreach ($lesson->exams as $exam)
        @php
        $userGrade = $exam->grades->where('user_id', $user->id)->first();
        @endphp
        <h2 class="sm:mb-3 text-sm text-stone-500 dark:text-neutral-400">
            Exam Description: {{ $exam->description }} - Grade: {{ $userGrade ? $userGrade->grade : 'Not Graded' }}
        </h2>
        @endforeach
    </div>
</div>
@empty
<div class="p-4 sm:p-5 bg-white border border-stone-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
    <div class="sm:flex sm:gap-x-3">
        <div class="sm:order-1 grow space-y-1">
            <p class="text-lg md:text-xl font-semibold text-stone-800 dark:text-neutral-200">
                No exams found!
            </p>
        </div>
    </div>
</div>
@endforelse
@if ($lessonExams->hasPages())
{{ $lessonExams->links() }}
@endif
@endsection