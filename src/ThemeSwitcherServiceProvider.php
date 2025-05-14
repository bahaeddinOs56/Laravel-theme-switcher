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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'theme-switcher');

        $this->publishes([
            __DIR__.'/../config/theme-palettes.php' => config_path('theme-palettes.php'),
            __DIR__.'/../resources/views' => resource_path('views/vendor/theme-switcher'),
            __DIR__.'/../resources/js/theme-switcher.js' => public_path('js/theme-switcher.js'),
            __DIR__.'/../resources/css/theme-switcher.css' => public_path('css/theme-switcher.css'),
        ], 'theme-switcher');
    }
} 