@extends('layouts.dashboard')
@section('content')

@forelse ($lessons as $lesson)
<div class="p-4 sm:p-5 bg-white border border-stone-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
    <div class="sm:order-1 grow space-y-1">
        <h2 class="text-lg md:text-xl font-semibold text-stone-800 dark:text-neutral-200">
            Time: {{ $lesson->time }}
        </h2>
        <h2 class="text-lg md:text-xl font-semibold text-stone-800 dark:text-neutral-200">
            Duration: {{ $lesson->duration }} Minutes
        </h2>
        <h2 class="sm:mb-3 text-sm text-stone-500 dark:text-neutral-400">
            Subject: {{ $lesson->subject->name }}
        </h2>
        <h2 class="sm:mb-3 text-sm text-stone-500 dark:text-neutral-400">
            Teacher: {{ $lesson->teacher->name }}
        </h2>
        <h2 class="sm:mb-3 text-sm text-stone-500 dark:text-neutral-400">
            {{ optional($lesson->attendances->first())->status === 1 ? 'Attendance: Present' : (optional($lesson->attendances->first())->status === 0 ? 'Attendance: Absent' : '') }}
        </h2>
    </div>
</div>
@empty
<div class="p-4 sm:p-5 bg-white border border-stone-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
    <div class="sm:flex sm:gap-x-3">
        <div class="sm:order-1 grow space-y-1">
            <p class="text-lg md:text-xl font-semibold text-stone-800 dark:text-neutral-200">
                No lessons available!
            </p>
        </div>
    </div>
</div>
@endforelse
@if ($lessons->hasPages())
{{ $lessons->links() }}
@endif
@endsection