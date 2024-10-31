@extends('layouts.dashboard')
@section('content')

<div class="relative overflow-hidden">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-24">
        <div class="text-center">
            <h1 class="text-4xl sm:text-6xl font-bold text-gray-800 dark:text-neutral-200">
                Permission
            </h1>

            <p class="mt-3 text-gray-600 dark:text-neutral-400">
                Create a new Permission
            </p>

            <div class="mt-7 sm:mt-12 mx-auto max-w-xl relative">
                <form method="POST" action="{{ route('permissions.store') }}" id="permission-form">
                    @csrf
                    <div class="relative z-10 flex gap-x-3 p-3 bg-white border rounded-lg shadow-lg shadow-gray-100 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-gray-900/20">
                        <div class="w-full">
                            <input type="text" name="name" id="hs-input-1" class="py-2.5 px-4 block w-full border-transparent rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" value="{{ old('name') }}" placeholder="{{ __('Permission Name') }}" required>
                            @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                            @error('selected_ids')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="size-[46px] inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="hidden md:block absolute top-0 end-0 -translate-y-12 translate-x-20">
                        <svg class="w-16 h-auto text-orange-500" width="121" height="135" viewBox="0 0 121 135" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 16.4754C11.7688 27.4499 21.2452 57.3224 5 89.0164" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                            <path d="M33.6761 112.104C44.6984 98.1239 74.2618 57.6776 83.4821 5" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                            <path d="M50.5525 130C68.2064 127.495 110.731 117.541 116 78.0874" stroke="currentColor" stroke-width="10" stroke-linecap="round" />
                        </svg>
                    </div>

                    <input type="hidden" name="selected_ids" id="selected-ids">

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead>
                            <tr class="border-t border-gray-200 divide-x divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">
                                <th scope="col">
                                    <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                        Select
                                    </button>
                                </th>
                                <th scope="col">
                                    <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                        ID
                                    </button>
                                </th>
                                <th scope="col" class="min-w-[250px] ">
                                    <button id="hs-pro-snms" type="button" class="px-4 py-2.5 text-start w-full flex items-center gap-x-1 text-sm font-normal text-gray-500 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                        Name
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @forelse ($roles as $role)
                            <tr class="divide-x divide-gray-200 dark:divide-neutral-700">
                                <td class="size-px whitespace-nowrap">
                                    <div class="px-3 py-4">
                                        <input type="checkbox" class="shrink-0 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" value="{{ $role->id }}" name="role_ids[]">
                                    </div>
                                </td>
                                <td class="size-px whitespace-nowrap px-4 py-1">
                                    <div class="w-full flex items-center gap-x-3">
                                        <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $role->id }}
                                        </span>
                                    </div>
                                </td>
                                <td class="size-px whitespace-nowrap px-4 py-1">
                                    <div class="w-full flex items-center gap-x-3">
                                        <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $role->name }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>
                                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        No roles found! | Create roles first
                                    </span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection