<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/theme-switcher.js') }}" defer></script>
    <style>
        :root {
            --theme-primary: #ffb5a7;
            --theme-secondary: #fcd5ce;
            --theme-accent: #f8edeb;
            --theme-background: #f9dcc4;
        }

        .theme-sidebar {
            background: linear-gradient(to bottom, var(--theme-primary), var(--theme-secondary));
        }

        .theme-button {
            background-color: var(--theme-accent);
            color: var(--theme-background);
        }

        .theme-button:hover {
            background-color: var(--theme-primary);
        }

        .theme-background {
            background-color: var(--theme-background);
        }
    </style>
</head>
<body class="theme-background">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 theme-sidebar text-white shadow-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Dashboard</h1>
            </div>
            <nav class="mt-6">
                <a href="#" class="flex items-center px-6 py-3 text-white theme-button hover:bg-opacity-80 transition-colors">
                    <span class="mx-3">Home</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-white theme-button hover:bg-opacity-80 transition-colors">
                    <span class="mx-3">Profile</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-white theme-button hover:bg-opacity-80 transition-colors">
                    <span class="mx-3">Settings</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Theme Switcher -->
            <div class="absolute top-4 right-4">
                @include('vendor.theme-switcher.switcher')
            </div>
            
            <main class="p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html> 