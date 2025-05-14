<?php

namespace Bahae\LaravelThemeSwitcher;

use Illuminate\Database\Eloquent\Model;

class ThemePreset extends Model
{
    protected $fillable = [
        'name',
        'description',
        'theme_key',
        'settings',
        'is_public',
        'created_by'
    ];

    protected $casts = [
        'settings' => 'array',
        'is_public' => 'boolean'
    ];

    /**
     * Get all public presets for a theme
     *
     * @param string $themeKey
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getPublicPresets(string $themeKey)
    {
        return self::where('theme_key', $themeKey)
            ->where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get user's presets for a theme
     *
     * @param string $themeKey
     * @param string $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getUserPresets(string $themeKey, string $userId)
    {
        return self::where('theme_key', $themeKey)
            ->where('created_by', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Apply preset settings to the current theme
     *
     * @return void
     */
    public function apply()
    {
        $theme = app(Theme::class);
        $theme->setTheme($this->theme_key);
        
        foreach ($this->settings as $key => $value) {
            $theme->setSetting($key, $value);
        }
    }

    /**
     * Create a preset from current theme settings
     *
     * @param string $name
     * @param string $description
     * @param bool $isPublic
     * @param string|null $userId
     * @return self
     */
    public static function createFromCurrent(string $name, string $description = null, bool $isPublic = false, ?string $userId = null)
    {
        $theme = app(Theme::class);
        
        return self::create([
            'name' => $name,
            'description' => $description,
            'theme_key' => $theme->getCurrentTheme(),
            'settings' => $theme->getCurrentSettings(),
            'is_public' => $isPublic,
            'created_by' => $userId
        ]);
    }
} 