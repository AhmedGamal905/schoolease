@extends('layouts.dashboard')
@section('content')
<form action="{{ route('attendance.store', $lesson) }}" method="POST">
    @csrf
    <button type="submit" class="py-2 px-2.5 mb-4 inline-flex items-center gap-x-1.5 text-s font-semibold rounded-lg border border-transparent bg-violet-500 text-white hover:bg-violet-600 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-violet-600 dark:focus:ring-violet-700">
        Save
    </button>

    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
        <thead>
            <tr class="border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                <th scope="col" class="w-1/4">
                    <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        Attendance
                    </button>
                </th>
                <th scope="col" class="w-3/4">
                    <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        Student Name
                    </button>
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
            @forelse ($users as $user)
            <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
                <td class="py-3 ps-3 w-1/4">
                    <div class="flex items-center h-5">
                        <select name="attendance[{{ $user->id }}]" class="border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:focus:ring-offset-gray-800 text-sm py-1">
                            <option value="0" {{ $user->attendances->isEmpty() || ($user->attendances->first()->status ?? null) == 0 ? 'selected' : '' }}>Absent</option>
                            <option value="1" {{ !$user->attendances->isEmpty() && ($user->attendances->first()->status ?? null) == 1 ? 'selected' : '' }}>Present</option>
                        </select>
                    </div>
                </td>
                <td class="size-px whitespace-nowrap px-4 py-1 w-3/4">
                    <div class="w-full flex items-center gap-x-3">
                        <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                            {{ $user->name }}
                        </span>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2">
                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                        No students found!
                    </span>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</form>
@endsection