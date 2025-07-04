@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold">Profile Settings</h2>
                    <p class="text-gray-600 dark:text-gray-400">Manage your account information and security settings.</p>
                </div>

                <div class="space-y-6">
                    <div class="p-4 sm:p-8 bg-gray-50 dark:bg-gray-700 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div> 
                    </div>

                    <div class="p-4 sm:p-8 bg-gray-50 dark:bg-gray-700 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-red-50 dark:bg-red-900 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
