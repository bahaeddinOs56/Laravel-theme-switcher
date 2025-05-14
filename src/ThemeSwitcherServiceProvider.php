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
            // Theme Preview Routes
            Route::get('/preview', 'ThemePreviewController@show')->name('theme-switcher.preview');
            Route::post('/preview', 'ThemePreviewController@preview')->name('theme-switcher.preview.theme');
            Route::post('/apply', 'ThemePreviewController@apply')->name('theme-switcher.apply');

            // Theme Customizer Routes
            Route::get('/customize', 'ThemeCustomizerController@show')->name('theme-switcher.customize');
            Route::post('/save-custom', 'ThemeCustomizerController@save')->name('theme-switcher.save-custom');
            Route::delete('/delete-custom/{themeKey}', 'ThemeCustomizerController@delete')->name('theme-switcher.delete-custom');
            
            // Theme Export/Import Routes
            Route::get('/export/{themeKey}', 'ThemeCustomizerController@export')->name('theme-switcher.export');
            Route::post('/import', 'ThemeCustomizerController@import')->name('theme-switcher.import');
            
            // Theme Analytics Routes
            Route::get('/analytics', 'ThemeAnalyticsController@show')->name('theme-switcher.analytics');
            Route::get('/analytics/stats/{themeKey}', 'ThemeAnalyticsController@getThemeStats')->name('theme-switcher.analytics.stats');
            Route::get('/analytics/trends/{themeKey}', 'ThemeAnalyticsController@getThemeTrends')->name('theme-switcher.analytics.trends');
            Route::post('/analytics/track', 'ThemeAnalyticsController@trackSwitch')->name('theme-switcher.analytics.track');

            // Theme Preset Routes
            Route::get('/presets', 'ThemePresetController@show')->name('theme-switcher.presets');
            Route::post('/presets/save', 'ThemePresetController@save')->name('theme-switcher.presets.save');
            Route::post('/presets/apply/{id}', 'ThemePresetController@apply')->name('theme-switcher.presets.apply');
            Route::delete('/presets/delete/{id}', 'ThemePresetController@delete')->name('theme-switcher.presets.delete');
        });
    }
} 