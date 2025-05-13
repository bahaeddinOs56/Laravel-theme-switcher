<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Add your CSS here -->
    <script src="{{ asset('js/theme-switcher.js') }}" defer></script>
</head>
<body>
    <header>
        @include('vendor.theme-switcher.switcher')
    </header>
    @yield('content')
</body>
</html> 