@extends('layouts.dashboard')
@section('content')

<a href="{{ route('lessons.create') }}" class="py-2 px-2.5 inline-flex items-center gap-x-1.5 text-xs font-semibold rounded-lg border border-transparent bg-violet-500 text-white hover:bg-violet-600 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-violet-600 dark:focus:ring-violet-700">
    <svg class="hidden sm:block shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14" />
        <path d="M12 5v14" />
    </svg>
    New Lesson
</a>

<table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
    <thead>
        <tr class="border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
            <th scope="col">
                <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    ID
                </button>
            </th>
            <th scope="col">
                <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Classroom
                </button>
            </th>
            <th scope="col">
                <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Subject
                </button>
            </th>
            <th scope="col">
                <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    TIme
                </button>
            </th>
            <th scope="col">
                <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Duration
                </button>
            </th>
            <th scope="col">
                <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    Cancel
                </button>
            </th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
        @forelse ($lessons as $lesson)
        <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
            <td class="size-px whitespace-nowrap px-4 py-1">
                <div class="w-full flex items-center gap-x-3">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $lesson->id }}
                    </span>
                </div>
            </td>
            @foreach($lesson->classrooms as $classroom)
            <td class="size-px whitespace-nowrap px-4 py-1">
                <div class="w-full flex items-center gap-x-3">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $classroom->name }}
                    </span>
                </div>
            </td>
            @endforeach
            <td class="size-px whitespace-nowrap px-4 py-1">
                <div class="w-full flex items-center gap-x-3">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $lesson->subject->name }}
                    </span>
                </div>
            </td>
            <td class="size-px whitespace-nowrap px-4 py-1">
                <div class="w-full flex items-center gap-x-3">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $lesson->time }}
                    </span>
                </div>
            </td>
            <td class="size-px whitespace-nowrap px-4 py-1">
                <div class="w-full flex items-center gap-x-3">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $lesson->duration }} Minutes
                    </span>
                </div>
            </td>
            <td class="size-px whitespace-nowrap px-4 py-1">
                <form method="POST" action="{{ route('lessons.destroy', $lesson) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-stone-200 bg-white text-red-500 shadow-sm hover:bg-stone-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-stone-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-red-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        Cancel
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td>
                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                    No lessons found!
                </span>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@if ($lessons->hasPages())
{{ $lessons->links() }}
@endif

@endsection