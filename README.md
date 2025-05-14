# Laravel Theme Switcher

A powerful theme switcher package for Laravel applications that provides beautiful, customizable themes with advanced features like theme persistence, special effects, and responsive design.

## Features

- 🎨 Three premium themes (Modern Dark, Minimal Light, Ocean Breeze)
- 🌊 Special effects (glass morphism, wave animations)
- 💾 Multiple storage options (session, cookie, database)
- 🎯 Enhanced component styling
- 📱 Responsive design
- ♿ Accessibility improvements
- 🔄 Smooth transitions and animations
- 🎭 Customizable color schemes
- 📦 Easy installation and configuration

## Installation

You can install the package via composer:

```bash
composer require bahae/laravel-theme-switcher
```

## Configuration

1. Publish the package assets:

```bash
php artisan vendor:publish --tag=theme-switcher
```

2. If you want to use database storage for theme persistence, publish and run the migrations:

```bash
php artisan vendor:publish --tag=theme-switcher-migrations
php artisan migrate
```

3. Configure the theme storage in `config/themes.php`:

```php
'storage' => 'session', // Options: 'session', 'cookie', 'database'
```

## Usage

1. Include the theme assets in your layout:

```php
<!-- In your layout file -->
<link href="{{ asset('css/theme-switcher.css') }}" rel="stylesheet">
<script src="{{ asset('js/theme-switcher.js') }}" defer></script>

<!-- Add the theme switcher component -->
@include('vendor.theme-switcher.switcher')
```

2. Use the theme classes in your HTML:

```html
<!-- Basic Components -->
<div class="card">
    <h2 class="text-primary">Title</h2>
    <p class="text-secondary">Content</p>
    <button class="btn-primary">Primary Action</button>
    <button class="btn-secondary">Secondary Action</button>
</div>

<!-- Surface Elements -->
<div class="surface">
    <!-- Content with hover effect -->
</div>

<!-- Status Indicators -->
<span class="status-success">Success message</span>
<span class="status-warning">Warning message</span>
<span class="status-error">Error message</span>

<!-- Ocean Theme Special Effects -->
<div class="card glass-effect">
    <div class="wave-animation">
        <!-- Content with wave effect -->
    </div>
</div>
```

## Available Themes

### Modern Dark Theme
- Dark background with proper contrast
- Accent colors with hover states
- Enhanced shadow effects
- Proper text hierarchy

### Minimal Light Theme
- Clean, minimal design
- Subtle shadows and borders
- Proper spacing and typography
- Smooth transitions

### Ocean Breeze Theme
- Gradient background
- Glass effect components
- Wave animation
- Water-inspired color scheme

## Theme Customization

You can customize themes by editing the `config/themes.php` file. Each theme supports:

- Colors (background, surface, primary, secondary, text)
- Shadows (small, medium, large)
- Typography (font family, size, line height)
- Border radius (small, medium, large)
- Special effects (glass effect, wave animation)

Example configuration:

```php
'themes' => [
    'custom' => [
        'name' => 'Custom Theme',
        'description' => 'My custom theme',
        'colors' => [
            'background' => '#ffffff',
            'surface' => '#f3f4f6',
            'primary' => '#3b82f6',
            // ... more colors
        ],
        'shadows' => [
            'small' => '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
            // ... more shadows
        ],
        // ... more properties
    ],
],
```

## Theme Persistence

The package supports three storage options:

1. **Session Storage** (default)
   - Theme preference persists during the session
   - No database required

2. **Cookie Storage**
   - Theme preference persists for 30 days
   - No database required

3. **Database Storage**
   - Theme preference persists per user
   - Requires running migrations
   - Supports custom colors per user

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email [your-email@example.com](mailto:your-email@example.com) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
