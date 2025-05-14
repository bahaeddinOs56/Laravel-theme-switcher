<?php

namespace Bahae\LaravelThemeSwitcher;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ThemeSwitcherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/themes.php', 'themes'
        );

        $this->app->singleton(Theme::class, function ($app) {
            return new Theme();
        });
    }

    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__.'/../config/themes.php' => config_path('themes.php'),
        ], 'theme-switcher-config');

        // Publish assets
        $this->publishes([
            __DIR__.'/../resources/css' => public_path('css'),
            __DIR__.'/../resources/js' => public_path('js'),
        ], 'theme-switcher');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'theme-switcher-migrations');

        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'theme-switcher');

        // Register routes
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::group([
            'prefix' => 'theme-switcher',
            'middleware' => ['web'],
            'namespace' => 'Bahae\LaravelThemeSwitcher',
        ], function () {
            Route::get('/preview', 'ThemePreviewController@show')->name('theme-switcher.preview');
            Route::post('/preview', 'ThemePreviewController@preview')->name('theme-switcher.preview.theme');
            Route::post('/apply', 'ThemePreviewController@apply')->name('theme-switcher.apply');
        });
    }
} 