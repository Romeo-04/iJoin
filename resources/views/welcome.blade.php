    <title>{{ config('app.name', 'EventEase') }} - Event Management Made Easy</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .auth-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <img id="welcome-logo" src="{{ asset('images/logo (normal).svg') }}" alt="Application Logo" class="w-10 h-6 text-indigo-600">
                    <h1 class="ml-3 text-xl font-bold text-gray-900 dark:text-white">EventEase</h1>
                </div>

                <!-- Theme Toggle -->
                <button id="theme-toggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2L13.09 8.26L20 9L14 14.74L15.18 21.02L10 18L4.82 21.02L6 14.74L0 9L6.91 8.26L10 2Z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    @if (Route::has('login'))
        @auth
            <!-- Authenticated User - Redirect to Dashboard -->
            <div class="min-h-screen bg-gradient-to-br from-blue-400 to-purple-500 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 flex items-center justify-center">
                <div class="text-center">
                    <div class="mb-8">
                        <img id="welcome-logo-auth" src="{{ asset('images/logo (normal).svg') }}" alt="Application Logo" class="w-20 h-20 text-indigo-600 mx-auto filter dark:invert">
                    </div>
                    <div class="bg-transparent text-center mx-auto w-full max-w-3xl">
                        <h1 class="text-4xl font-bold text-white mb-4">Welcome back to EventEase!</h1>
                        <p class="mb-8 text-white">You're already logged in.</p>
                        <a href="{{ url('/dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition duration-300 shadow-lg">
                            Go to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Landing Page for Guests -->
            <div class="min-h-screen bg-gradient-to-br from-blue-400 to-purple-500 dark:from-gray-900 dark:via-gray-900 dark:to-gray-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl w-full space-y-8">
                    <!-- Header -->
                    <div class="text-center">
                        <div class="mb-8">
                            <img id="welcome-logo-guest" src="{{ asset('images/logo (normal).svg') }}" alt="Application Logo" class="w-16 h-16 text-white mx-auto">
                        </div>
                        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
                            Welcome to EventEase
                        </h1>
                        <p class="text-xl md:text-2xl text-gray-100 mb-8 max-w-2xl mx-auto">
                            Your all-in-one platform for creating, managing, and attending events. 
                            Get started today and make event management effortless.
                        </p>
                    </div>

                    <!-- Authentication Options -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                        <!-- Sign Up Card -->
                        <div class="auth-card bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 text-center">
                            <div class="mb-6">
                                <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">New to EventEase?</h2>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Create your free account and start organizing amazing events today.
                                </p>
                            </div>
                            
                            <div class="space-y-4">
                                <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2 mb-6">
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Free account setup
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Create unlimited events
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Easy ticket management
                                    </li>
                                </ul>
                                
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-6 rounded-lg font-semibold transition duration-300 shadow-lg block">
                                        Create Free Account
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Login Card -->
                        <div class="auth-card bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 text-center">
                            <div class="mb-6">
                                <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Already a Member?</h2>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Welcome back! Sign in to access your events and continue managing your activities.
                                </p>
                            </div>

                            <div class="space-y-4">
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Quick Access:</p>
                                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                        <li>• View your registered events</li>
                                        <li>• Download your tickets</li>
                                        <li>• Manage your profile</li>
                                    </ul>
                                </div>
                                
                                <a href="{{ route('login') }}" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-lg font-semibold transition duration-300 shadow-lg block">
                                    Sign In
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="text-center text-white mt-12">
                        <p class="text-lg mb-4">Trusted by event organizers worldwide</p>
                        <div class="flex justify-center items-center space-x-8 text-sm opacity-75">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Secure & Reliable
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Easy to Use
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                </svg>
                                24/7 Support
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    @endif

    <!-- Theme Toggle Script -->
    <script>
        // Theme toggle functionality
        const themeToggle = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // Initialize theme
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
        }

        // Toggle theme
        themeToggle.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
                darkIcon.classList.add('hidden');
                lightIcon.classList.remove('hidden');
            }
        });

        // Logo swap for welcome page (works for all logo instances)
        function updateWelcomeLogos() {
            const isDark = document.documentElement.classList.contains('dark');
            const normalLogo = "{{ asset('images/logo (normal).svg') }}";
            const nightLogo = "{{ asset('images/logo (night).svg') }}";
            [
                document.getElementById('welcome-logo'),
                document.getElementById('welcome-logo-auth'),
                document.getElementById('welcome-logo-guest')
            ].forEach(function(logo) {
                if (logo) logo.src = isDark ? nightLogo : normalLogo;
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            updateWelcomeLogos();
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        updateWelcomeLogos();
                    }
                });
            });
            observer.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['class']
            });
        });
    </script>
</body>