<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Toggle Test</title>
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
<body class="bg-white dark:bg-gray-900 text-black dark:text-white min-h-screen">
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-6">Theme Toggle Test</h1>
        
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg mb-6">
            <p class="text-lg mb-4">This is a test page to verify the theme toggle is working.</p>
            <p class="text-gray-600 dark:text-gray-300">This text should change color when switching themes.</p>
        </div>
        
        <!-- Theme Toggle Button -->
        <button id="theme-toggle" type="button" 
                class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg transition-colors">
            🌙 Toggle Theme
        </button>
        
        <div class="mt-6 p-4 border border-gray-300 dark:border-gray-600 rounded">
            <h3 class="font-bold mb-2">Current Theme Info:</h3>
            <p id="theme-info">Loading...</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Theme test page loaded');
            
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeInfo = document.getElementById('theme-info');
            
            function updateThemeInfo() {
                const isDark = document.documentElement.classList.contains('dark');
                const stored = localStorage.getItem('color-theme');
                themeInfo.innerHTML = `
                    Dark mode active: ${isDark}<br>
                    Stored preference: ${stored || 'none'}<br>
                    HTML classes: ${document.documentElement.className}
                `;
            }
            
            function toggleTheme() {
                console.log('Toggle clicked!');
                
                const html = document.documentElement;
                const isDark = html.classList.contains('dark');
                
                if (isDark) {
                    html.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    console.log('Switched to light mode');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    console.log('Switched to dark mode');
                }
                
                updateThemeInfo();
            }
            
            themeToggleBtn.addEventListener('click', toggleTheme);
            updateThemeInfo();
            
            console.log('Theme toggle test initialized');
        });
    </script>
</body>
</html>
