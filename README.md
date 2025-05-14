# Laravel Theme Switcher

A powerful and flexible theme management system for Laravel applications. This package provides a complete solution for managing themes, including theme switching, customization, presets, and analytics.

## Features

- 🎨 Multiple theme support
- 🎯 Theme preview functionality
- 🛠️ Theme customization interface
- 💾 Theme presets management
- 📊 Theme usage analytics
- 🔄 Theme export/import
- 🌙 Dark/Light mode support
- 📱 Responsive design
- 🎯 Premium themes support

## Installation

```bash
composer require bahaeddin/laravel-theme-switcher
```

Publish the configuration and assets:

```bash
php artisan vendor:publish --tag=theme-switcher-config
php artisan vendor:publish --tag=theme-switcher
php artisan vendor:publish --tag=theme-switcher-migrations
```

Run the migrations:

```bash
php artisan migrate
```

## Configuration

The package configuration file (`config/themes.php`) allows you to customize various aspects of the theme system:

```php
return [
    'default_theme' => 'light',
    'themes' => [
        'light' => [
            'name' => 'Light Theme',
            'colors' => [
                'primary' => '#007bff',
                'secondary' => '#6c757d',
                // ... other colors
            ],
            // ... other settings
        ],
        'dark' => [
            'name' => 'Dark Theme',
            'colors' => [
                'primary' => '#0d6efd',
                'secondary' => '#adb5bd',
                // ... other colors
            ],
            // ... other settings
        ],
    ],
];
```

## Usage

### Basic Theme Switching

```php
use Bahae\LaravelThemeSwitcher\Theme;

// Switch to a theme
Theme::setTheme('dark');

// Get current theme
$currentTheme = Theme::getCurrentTheme();

// Get theme settings
$settings = Theme::getCurrentSettings();
```

### Theme Preview

Visit `/theme-switcher/preview` to see the theme preview interface. This allows users to:

- Preview themes before applying
- See live changes
- Compare different themes
- Apply themes with one click

### Theme Customization

Visit `/theme-switcher/customize` to access the theme customizer. Features include:

- Color picker for theme colors
- Typography settings
- Shadow and border controls
- Live preview
- Save custom themes

### Theme Presets

Visit `/theme-switcher/presets` to manage theme presets. Features include:

- Save current theme configuration as a preset
- Apply saved presets
- Manage public and private presets
- Delete custom presets

```php
use Bahae\LaravelThemeSwitcher\ThemePreset;

// Create a preset from current theme
ThemePreset::createFromCurrent(
    'My Preset',
    'A custom theme configuration',
    true, // is public
    Auth::id() // user ID
);

// Get public presets
$publicPresets = ThemePreset::getPublicPresets('light');

// Get user presets
$userPresets = ThemePreset::getUserPresets('light', Auth::id());
```

### Theme Analytics

Visit `/theme-switcher/analytics` to view theme usage statistics. Features include:

- Theme switch tracking
- Usage statistics
- Trend analysis
- User preferences

```php
use Bahae\LaravelThemeSwitcher\ThemeAnalytics;

// Track a theme switch
ThemeAnalytics::trackSwitch('dark');

// Get theme statistics
$stats = ThemeAnalytics::getThemeStats('dark');

// Get theme trends
$trends = ThemeAnalytics::getThemeTrends('dark');
```

### Export/Import Themes

```php
use Bahae\LaravelThemeSwitcher\Theme;

// Export a theme
$themeData = Theme::exportTheme('dark');

// Import a theme
Theme::importTheme($themeData);
```

## Blade Components

The package includes several Blade components for easy integration:

```blade
{{-- Theme Switcher --}}
<x-theme-switcher::switcher />

{{-- Theme Preview --}}
<x-theme-switcher::preview />

{{-- Theme Customizer --}}
<x-theme-switcher::customizer />

{{-- Theme Analytics --}}
<x-theme-switcher::analytics />
```

## JavaScript API

The package provides a JavaScript API for theme management:

```javascript
// Initialize theme switcher
const themeSwitcher = new ThemeSwitcher();
themeSwitcher.init();

// Switch theme
themeSwitcher.switchTheme('dark');

// Get current theme
const currentTheme = themeSwitcher.getCurrentTheme();

// Save preset
themeSwitcher.savePreset({
    name: 'My Preset',
    description: 'A custom theme',
    isPublic: true
});
```

## Events

The package fires several events that you can listen to:

```php
// Theme switched
ThemeSwitched::class

// Theme customized
ThemeCustomized::class

// Preset created
PresetCreated::class

// Preset applied
PresetApplied::class
```

## Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).

## Support

For support, please open an issue on GitHub or contact the maintainers.

## Changelog

### v1.8.0
- Added theme presets functionality
- Added theme analytics
- Enhanced theme customization
- Improved UI/UX

### v1.7.0
- Added theme preview
- Added theme customization
- Enhanced theme switching

### v1.6.0
- Added premium themes
- Enhanced theme system
- Improved performance

[View full changelog](CHANGELOG.md)
