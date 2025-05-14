<?php

namespace Bahae\LaravelThemeSwitcher;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Theme
{
    protected $currentTheme;
    protected $storage;

    public function __construct()
    {
        $this->storage = Config::get('themes.storage', 'session');
        $this->currentTheme = $this->getStoredTheme() ?? Config::get('themes.default', 'light');
    }

    /**
     * Get the current theme
     *
     * @return string
     */
    public function getCurrentTheme(): string
    {
        return $this->currentTheme;
    }

    /**
     * Set the current theme
     *
     * @param string $theme
     * @return void
     */
    public function setTheme(string $theme): void
    {
        if (!array_key_exists($theme, Config::get('themes.themes', []))) {
            throw new \InvalidArgumentException("Theme '{$theme}' does not exist.");
        }

        $this->currentTheme = $theme;
        $this->storeTheme($theme);
    }

    /**
     * Get theme configuration
     *
     * @param string|null $theme
     * @return array
     */
    public function getThemeConfig(?string $theme = null): array
    {
        $theme = $theme ?? $this->currentTheme;
        return Config::get("themes.themes.{$theme}", []);
    }

    /**
     * Get all available themes
     *
     * @return array
     */
    public function getAvailableThemes(): array
    {
        return Config::get('themes.themes', []);
    }

    /**
     * Get stored theme from the configured storage
     *
     * @return string|null
     */
    protected function getStoredTheme(): ?string
    {
        switch ($this->storage) {
            case 'session':
                return Session::get('theme');
            case 'cookie':
                return Cookie::get('theme');
            case 'database':
                return DB::table('user_preferences')
                    ->where('user_id', auth()->id())
                    ->value('theme');
            default:
                return null;
        }
    }

    /**
     * Store theme in the configured storage
     *
     * @param string $theme
     * @return void
     */
    protected function storeTheme(string $theme): void
    {
        switch ($this->storage) {
            case 'session':
                Session::put('theme', $theme);
                break;
            case 'cookie':
                Cookie::queue('theme', $theme, 60 * 24 * 30); // 30 days
                break;
            case 'database':
                if (auth()->check()) {
                    DB::table('user_preferences')
                        ->updateOrInsert(
                            ['user_id' => auth()->id()],
                            ['theme' => $theme]
                        );
                }
                break;
        }
    }

    /**
     * Generate CSS variables for the current theme
     *
     * @return string
     */
    public function generateCssVariables(): string
    {
        $theme = $this->getThemeConfig();
        $css = ":root {\n";

        // Add color variables
        foreach ($theme['colors'] as $key => $value) {
            $css .= "    --theme-{$key}: {$value};\n";
        }

        // Add shadow variables
        foreach ($theme['shadows'] as $key => $value) {
            $css .= "    --theme-shadow-{$key}: {$value};\n";
        }

        // Add typography variables
        foreach ($theme['typography'] as $key => $value) {
            $css .= "    --theme-{$key}: {$value};\n";
        }

        // Add border radius variables
        foreach ($theme['border-radius'] as $key => $value) {
            $css .= "    --theme-border-radius-{$key}: {$value};\n";
        }

        // Add theme-specific effects
        if (isset($theme['effects'])) {
            foreach ($theme['effects'] as $key => $value) {
                $css .= "    --theme-effect-{$key}: " . ($value ? '1' : '0') . ";\n";
            }
        }

        $css .= "}\n";

        // Add theme-specific styles
        if ($this->currentTheme === 'ocean') {
            $css .= $this->generateOceanThemeStyles();
        }

        return $css;
    }

    /**
     * Generate additional styles for the Ocean theme
     *
     * @return string
     */
    protected function generateOceanThemeStyles(): string
    {
        return "
        /* Ocean Theme Specific Styles */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .wave-animation {
            position: relative;
            overflow: hidden;
        }

        .wave-animation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, 
                rgba(255, 255, 255, 0.1) 25%, 
                transparent 25%, 
                transparent 50%, 
                rgba(255, 255, 255, 0.1) 50%, 
                rgba(255, 255, 255, 0.1) 75%, 
                transparent 75%, 
                transparent);
            background-size: 100px 100px;
            animation: wave 10s linear infinite;
            opacity: 0.1;
        }

        @keyframes wave {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 100px 100px;
            }
        }
        ";
    }
} 