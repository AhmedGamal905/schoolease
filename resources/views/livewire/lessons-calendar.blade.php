<div class="flex flex-col bg-white border border-stone-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
    <div class="py-3 px-5 flex justify-between items-center gap-x-5 border-b border-stone-200 dark:border-neutral-700">
        <h2 class="inline-block font-semibold text-stone-800 dark:text-neutral-200">
            Create lesson
        </h2>
    </div>
    <div class="p-5 space-y-4" wire:ignore>
        <div>
            <label class="block mb-2 text-sm font-medium text-stone-800 dark:text-neutral-200">
                Classroom
            </label>
            <div class="relative">
                <select wire:model.live.debounce.500ms="classroom" data-hs-select='{
                          "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                          "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-stone-200 rounded-lg text-start text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                          "dropdownClasses": "mt-2 z-50 w-full min-w-36 max-h-72 z-50 p-1 space-y-0.5 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:bg-neutral-900",
                          "optionClasses": "hs-selected:bg-stone-100 dark:hs-selected:bg-neutral-800 py-2 px-4 w-full text-sm text-stone-800 cursor-pointer hover:bg-stone-100 rounded-lg focus:outline-none focus:bg-stone-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                          "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-stone-800 dark:text-neutral-200\" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>"
                        }' class="hidden">
                    <option>Pick a classroom</option>
                    @forelse ($classrooms as $classroom)
                    <option value="{{$classroom->id}}">{{ $classroom->name }}</option>
                    @empty
                    <option>No Available</option>
                    @endforelse
                </select>
                <div class="absolute top-1/2 end-2.5 -translate-y-1/2">
                    <svg class="shrink-0 size-3.5 text-stone-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m7 15 5 5 5-5" />
                        <path d="m7 9 5-5 5 5" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @error('classroom')
    <p class="mt-1 mx-5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    <div class="p-5 space-y-4" wire:ignore>
        <div>
            <label class="block mb-2 text-sm font-medium text-stone-800 dark:text-neutral-200">
                Subject
            </label>
            <div class="relative">
                <select wire:model="subject" data-hs-select='{
                          "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                          "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-stone-200 rounded-lg text-start text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                          "dropdownClasses": "mt-2 z-50 w-full min-w-36 max-h-72 z-50 p-1 space-y-0.5 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:bg-neutral-900",
                          "optionClasses": "hs-selected:bg-stone-100 dark:hs-selected:bg-neutral-800 py-2 px-4 w-full text-sm text-stone-800 cursor-pointer hover:bg-stone-100 rounded-lg focus:outline-none focus:bg-stone-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                          "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-stone-800 dark:text-neutral-200\" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>"
                        }' class="hidden">
                    <option>Pick a subject</option>
                    @forelse ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @empty
                    <option>No available subjects</option>
                    @endforelse
                </select>

                <div class="absolute top-1/2 end-2.5 -translate-y-1/2">
                    <svg class="shrink-0 size-3.5 text-stone-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m7 15 5 5 5-5" />
                        <path d="m7 9 5-5 5 5" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @error('subject')
    <p class="mt-1 mx-5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    <div class="p-5 space-y-4">
        <div>
            <div>
                <label class="block mb-2 text-sm font-medium text-stone-800 dark:text-neutral-200">
                    Select a date
                </label>
                <input type="date" class="py-2 px-4 w-full bg-white border border-stone-200 rounded-lg text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:focus:ring-neutral-600" wire:model.live.debounce.500ms="date">
            </div>
        </div>
    </div>
    @error('date')
    <p class="mt-1 mx-5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    <div class="p-5 space-y-4">
        <label class="block mb-2 text-sm font-medium text-stone-800 dark:text-neutral-200">
            Existing lessons
        </label>
        @forelse ($lessons as $lesson)
        <div class="p-4 sm:p-5 bg-white border border-stone-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
            <div class="sm:flex sm:gap-x-3">
                <div class="sm:order-1 grow space-y-1">
                    <p class="text-lg md:text-xl font-semibold text-stone-800 dark:text-neutral-200">
                        Subject: {{ $lesson->subject->name }}
                    </p>
                </div>
            </div>

            <div class="mt-1 flex items-center gap-x-2">
                <span class="text-sm leading-5 text-stone-500 dark:text-neutral-400">
                    Time: {{ $lesson->time }}
                </span>
            </div>
            <div class="mt-1 flex items-center gap-x-2">
                <span class="text-sm leading-5 text-stone-500 dark:text-neutral-400">
                    Duration: {{ $lesson->duration }} Minutes
                </span>
            </div>
        </div>
        @empty
        <div class="p-4 sm:p-5 bg-white border border-stone-200 rounded-xl shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
            <div class="sm:flex sm:gap-x-3">
                <div class="sm:order-1 grow space-y-1">
                    <p class="text-lg md:text-sm font-semibold text-stone-800 dark:text-neutral-200">
                        No lessons found for the selected date for this classroom.
                    </p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    <div class="p-5 space-y-4">
        <div>
            <div>
                <label class="block mb-2 text-sm font-medium text-stone-800 dark:text-neutral-200">
                    Select a time
                </label>
                <input type="time" class="py-2 px-4 w-full bg-white border border-stone-200 rounded-lg text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:focus:ring-neutral-600" wire:model.live.debounce.500ms="time">
            </div>
        </div>
    </div>
    @error('time')
    <p class="mt-1 mx-5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    <div class="p-5 space-y-4" wire:ignore>
        <div>
            <label class="block mb-2 text-sm font-medium text-stone-800 dark:text-neutral-200">
                Duration
            </label>
            <div class="relative">
                <select wire:model="duration" data-hs-select='{
                          "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                          "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-stone-200 rounded-lg text-start text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                          "dropdownClasses": "mt-2 z-50 w-full min-w-36 max-h-72 z-50 p-1 space-y-0.5 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:bg-neutral-900",
                          "optionClasses": "hs-selected:bg-stone-100 dark:hs-selected:bg-neutral-800 py-2 px-4 w-full text-sm text-stone-800 cursor-pointer hover:bg-stone-100 rounded-lg focus:outline-none focus:bg-stone-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                          "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-stone-800 dark:text-neutral-200\" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>"
                        }' class="hidden">
                    <option>Duration in minutes</option>
                    <option value="15">15 Minutes</option>
                    <option value="30">30 Minutes</option>
                    <option value="45">45 Minutes</option>
                    <option value="60">60 Minutes</option>
                </select>

                <div class="absolute top-1/2 end-2.5 -translate-y-1/2">
                    <svg class="shrink-0 size-3.5 text-stone-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m7 15 5 5 5-5" />
                        <path d="m7 9 5-5 5 5" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @error('duration')
    <p class="mt-1 mx-5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    <button type="button" wire:click="createLesson" class="py-3 m-5 px-4 inline-flex justify-center items-center gap-x-2 text-l font-medium rounded-lg border border-stone-200 bg-white text-green-500 shadow-sm hover:bg-stone-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-stone-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-green-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
        Create
    </button>
</div>