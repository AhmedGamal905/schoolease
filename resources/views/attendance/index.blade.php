@extends('layouts.dashboard')
@section('content')

@forelse ($lessons as $lesson)
<div class="p-4 sm:p-5 bg-white border border-stone-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
    <div class="sm:flex sm:gap-x-3">
        <svg class="sm:order-2 mb-2 sm:mb-0 shrink-0 size-6 text-stone-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="4" y="10" width="16" height="10" />
            <polygon points="12,2 4,10 20,10" />
            <line x1="8" x2="8" y1="10" y2="20" />
            <line x1="16" x2="16" y1="10" y2="20" />
            <line x1="4" x2="20" y1="14" y2="14" />
        </svg>
        <a href="{{ route('attendance.show', $lesson) }}" class="py-2 px-2.5 inline-flex items-center gap-x-1.5 text-xs font-semibold rounded-lg border border-transparent bg-violet-500 text-white hover:bg-violet-600 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-violet-600 dark:focus:ring-violet-700">
            <svg class="hidden sm:block shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            Attendance
        </a>
        <div class="sm:order-1 grow space-y-1">
            <h2 class="sm:mb-3 text-sm text-stone-500 dark:text-neutral-400">
                Classroom: {{ $lesson->classrooms->first()->name }}
            </h2>
            <h2 class="text-lg md:text-xl font-semibold text-stone-800 dark:text-neutral-200">
                Time: {{ $lesson->time }}
            </h2>
            <h2 class="text-lg md:text-xl font-semibold text-stone-800 dark:text-neutral-200">
                Duration: {{ $lesson->duration }} Minutes
            </h2>
            <h2 class="sm:mb-3 text-sm text-stone-500 dark:text-neutral-400">
                Subject: {{ $lesson->subject->name }}
            </h2>
        </div>
    </div>
</div>
@empty
<div class="p-4 sm:p-5 bg-white border border-stone-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
    <div class="sm:flex sm:gap-x-3">
        <div class="sm:order-1 grow space-y-1">
            <h2 class="sm:mb-3 text-sm text-stone-500 dark:text-neutral-400">
                Register some lessons first
            </h2>
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