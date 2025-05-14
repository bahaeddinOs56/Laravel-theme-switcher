# Laravel Theme Switcher

A simple theme switcher package for Laravel applications that allows users to switch between different color themes.

## Installation

You can install the package via composer:

```bash
composer require bahae/laravel-theme-switcher
```

## Usage

1. Publish the package assets:

```bash
php artisan vendor:publish --provider="Bahae\LaravelThemeSwitcher\ThemeSwitcherServiceProvider"
```

2. Include the theme switcher in your layout:

```php
<!-- In your layout file -->
<link href="{{ asset('css/theme-switcher.css') }}" rel="stylesheet">
<script src="{{ asset('js/theme-switcher.js') }}" defer></script>

<!-- Add the theme switcher component -->
@include('vendor.theme-switcher.switcher')
```

3. Use the theme classes in your HTML:

```html
<!-- For sidebars -->
<div class="theme-sidebar">
    <!-- Sidebar content -->
</div>

<!-- For buttons -->
<button class="theme-button">Click me</button>

<!-- For background -->
<div class="theme-background">
    <!-- Content -->
</div>
```

## Available Themes

The package comes with several pre-defined themes:

- Sunset
- Forest
- Ocean
- Pastel
- Midnight

## Customization

You can customize the themes by editing the `config/theme-palettes.php` file after publishing it.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
