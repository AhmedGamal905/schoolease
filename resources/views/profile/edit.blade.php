@extends('layouts.dashboard')
@section('content')
<div class="p-5 md:p-8 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
    <div class="mb-4 xl:mb-8">
        <h1 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
            Profile
        </h1>
        <p class="text-sm text-gray-500 dark:text-neutral-500">
            Manage your name, password and account settings.
        </p>
    </div>
    <form method="post" action="{{ route('profile.update') }}" class="py-6 sm:py-8 space-y-5 border-t border-gray-200 first:border-t-0 dark:border-neutral-700">
        @csrf
        @method('patch')

        <h2 class="font-semibold text-gray-800 dark:text-neutral-200">
            Personal info
        </h2>
        <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
            <div class="sm:col-span-4 xl:col-span-3 2xl:col-span-2">
                <label for="name" class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                    Name
                </label>
            </div>
            <div class="sm:col-span-8 xl:col-span-4">
                <input id="name" name="name" type="text" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Enter full name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            </div>
        </div>
        <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
            <div class="sm:col-span-4 xl:col-span-3 2xl:col-span-2">
                <label for="email" class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">
                    Email
                </label>
            </div>
            <div class="sm:col-span-8 xl:col-span-4">
                <input id="email" name="email" type="email" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="Enter email address" value="{{ old('email', $user->email) }}" required autocomplete="username">
            </div>
        </div>
        <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
            <div class="sm:col-span-4 xl:col-span-3 2xl:col-span-2"></div>
            <div class="sm:col-span-8 xl:col-span-4">
                <div class="flex gap-x-3">
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="py-6 sm:py-8 space-y-5 border-t border-gray-200 first:border-t-0 dark:border-neutral-700">
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div>
                <div class="inline-flex items-center gap-x-2">
                    <h2 class="font-semibold text-gray-800 dark:text-neutral-200">Change Password</h2>
                    <!-- Tooltip -->
                    <div class="hs-tooltip inline-block">
                        <!-- Tooltip Icon -->
                        <svg class="hs-tooltip-toggle shrink-0 ms-1 size-3 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                        <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-[60] p-4 w-96 bg-white rounded-xl shadow-xl dark:bg-neutral-900 dark:text-neutral-400" role="tooltip">
                            <p class="font-medium text-gray-800 dark:text-neutral-200">Password requirements:</p>
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-neutral-400">Ensure that these requirements are met:</p>
                            <ul class="mt-1 ps-3.5 list-disc list-outside text-sm font-normal text-gray-500 dark:text-neutral-400">
                                <li>Minimum 8 characters long - the more, the better</li>
                                <li>At least one lowercase character</li>
                                <li>At least one uppercase character</li>
                                <li>At least one number, symbol, or whitespace character</li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Tooltip -->
                </div>
            </div>

            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                <div class="sm:col-span-4 xl:col-span-3 2xl:col-span-2">
                    <label for="update_password_current_password" class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Current Password</label>
                </div>
                <div class="sm:col-span-8 xl:col-span-4">
                    <input id="update_password_current_password" name="current_password" type="password" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60" placeholder="Enter current password" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>
            </div>

            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                <div class="sm:col-span-4 xl:col-span-3 2xl:col-span-2">
                    <label for="update_password_password" class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">New Password</label>
                </div>
                <div class="sm:col-span-8 xl:col-span-4">
                    <input id="update_password_password" name="password" type="password" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60" placeholder="Enter new password" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>
            </div>

            <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
                <div class="sm:col-span-4 xl:col-span-3 2xl:col-span-2">
                    <label for="update_password_password_confirmation" class="sm:mt-2.5 inline-block text-sm text-gray-500 dark:text-neutral-500">Confirm Password</label>
                </div>
                <div class="sm:col-span-8 xl:col-span-4">
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60" placeholder="Repeat new password" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Change
                </button>

                @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
    <div class="py-6 sm:py-8 space-y-5 border-t border-gray-200 first:border-t-0 dark:border-neutral-700">
        <div class="grid sm:grid-cols-12 gap-y-1.5 sm:gap-y-0 sm:gap-x-5">
            <div class="sm:col-span-4 xl:col-span-3 2xl:col-span-2">
                <label class="inline-block text-sm text-gray-500 dark:text-neutral-500">
                    Danger zone
                </label>
            </div>
            <div class="sm:col-span-8 xl:col-span-4">
                <button type="button" x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class=" py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-red-500 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-red-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                    Delete my account
                </button>
            </div>
            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>

                    <div class="mt-6">
                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="{{ __('Password') }}" />

                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Delete Account') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>

    </div>
</div>
@endsection