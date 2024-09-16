@extends('layouts.dashboard')

@section('content')

<table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
    <thead>
        <tr class="border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
            <th scope="col">
                <button class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700">
                    ID
                </button>
            </th>
            <th scope="col" class="min-w-[250px] ">
                <button class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700">
                    Name
                </button>
            </th>
            <th scope="col" class="min-w-[250px] ">
                <button class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700">
                    Subjects
                </button>
            </th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
        @forelse ($users as $user)
        <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
            <td class="whitespace-nowrap px-4 py-1">
                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $user->id }}</span>
            </td>
            <td class="whitespace-nowrap px-4 py-1">
                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $user->name }}</span>
            </td>
            <td class="whitespace-nowrap px-4 py-1">
                @forelse ($subjects as $subject)
                @php
                $isAssigned = $user->subjects()->where('subject_id', $subject->id)->exists();
                @endphp
                <form action="{{ route('subject.toggle', [$user->id, $subject->id]) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-stone-200 {{ $isAssigned ? 'bg-white text-red-500' : 'bg-white text-green-500' }} shadow-sm hover:bg-stone-50 focus:outline-none dark:bg-neutral-800 dark:border-neutral-700 {{ $isAssigned ? 'dark:text-red-500 dark:hover:bg-neutral-700' : 'dark:text-green-500 dark:hover:bg-neutral-700' }}">
                        {{ $subject->name }}
                    </button>
                </form>
                @empty
                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">No subjects Available!</span>
                @endforelse
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3">
                <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">No teachers found!</span>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@if ($users->hasPages())
{{ $users->links() }}
@endif

@endsection