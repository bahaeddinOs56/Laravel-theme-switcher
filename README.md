# Laravel Theme Switcher

A beautiful and easy-to-use theme switcher package for Laravel applications. This package provides a floating button that allows users to switch between different color themes, with smooth transitions and persistent theme selection.

## Installation

You can install the package via composer:

```bash
composer require bahae/laravel-theme-switcher
```

After installing the package, publish the assets:

```bash
php artisan vendor:publish --provider="Bahae\LaravelThemeSwitcher\ThemeSwitcherServiceProvider"
```

This will publish:
- Configuration file (`config/theme-palettes.php`)
- Views (`resources/views/vendor/theme-switcher`)
- JavaScript assets (`public/js/theme-switcher.js`)

## Usage

1. Include the theme switcher in your layout file:

```php
// resources/views/layouts/app.blade.php
<!DOCTYPE html>
<html>
<head>
    <!-- ... other head elements ... -->
    <script src="{{ asset('js/theme-switcher.js') }}" defer></script>
</head>
<body>
    @include('vendor.theme-switcher.switcher')
    @yield('content')
</body>
</html>
```

2. The theme switcher will automatically:
   - Show a floating button with theme options
   - Remember the selected theme using localStorage
   - Apply the theme colors using CSS variables

## Customization

You can customize the available themes by editing the `config/theme-palettes.php` file:

```php
return [
    'sunset' => ['#ffb5a7', '#fcd5ce', '#f8edeb', '#f9dcc4'],
    'forest' => ['#355c4a', '#6b9080', '#a4c3b2', '#cce3de'],
    // Add your own themes here...
];
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
