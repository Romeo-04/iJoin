<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Theme Toggle Script -->
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-900 bg-gradient-to-br from-blue-400 to-purple-500">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        <script>
            // Theme toggle functionality
            document.addEventListener('DOMContentLoaded', function() {
                const themeToggleBtn = document.getElementById('theme-toggle');
                const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');
                
                function toggleTheme() {
                    const html = document.documentElement;
                    const isDark = html.classList.contains('dark');
                    
                    if (isDark) {
                        html.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                        updateIcons(false);
                    } else {
                        html.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                        updateIcons(true);
                    }
                }
                
                function updateIcons(isDark) {
                    const darkIcon = document.getElementById('theme-toggle-dark-icon');
                    const lightIcon = document.getElementById('theme-toggle-light-icon');
                    const darkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
                    const lightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');
                    
                    if (isDark) {
                        // Dark mode - show sun icons (to switch back to light)
                        if (lightIcon) lightIcon.classList.remove('hidden');
                        if (darkIcon) darkIcon.classList.add('hidden');
                        if (lightIconMobile) lightIconMobile.classList.remove('hidden');
                        if (darkIconMobile) darkIconMobile.classList.add('hidden');
                    } else {
                        // Light mode - show moon icons (to switch to dark)
                        if (darkIcon) darkIcon.classList.remove('hidden');
                        if (lightIcon) lightIcon.classList.add('hidden');
                        if (darkIconMobile) darkIconMobile.classList.remove('hidden');
                        if (lightIconMobile) lightIconMobile.classList.add('hidden');
                    }
                }
                
                // Add event listeners
                if (themeToggleBtn) {
                    themeToggleBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        toggleTheme();
                    });
                }
                
                if (themeToggleMobileBtn) {
                    themeToggleMobileBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        toggleTheme();
                    });
                }
                
                // Initialize theme on load
                const savedTheme = localStorage.getItem('color-theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const isDark = savedTheme === 'dark' || (!savedTheme && prefersDark);
                
                if (isDark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
                
                updateIcons(isDark);
            });
        </script>
    </body>
</html>
