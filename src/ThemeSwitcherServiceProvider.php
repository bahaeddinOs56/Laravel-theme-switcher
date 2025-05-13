<?php

namespace Bahae\LaravelThemeSwitcher;

use Illuminate\Support\ServiceProvider;

class ThemeSwitcherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/theme-palettes.php', 'theme-palettes'
        );
    }

    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__.'/../config/theme-palettes.php' => config_path('theme-palettes.php'),
        ], 'config');

        // Publish views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'theme-switcher');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/theme-switcher'),
        ], 'views');

        // Publish assets
        $this->publishes([
            __DIR__.'/../resources/js' => public_path('js'),
        ], 'assets');
    }
} 