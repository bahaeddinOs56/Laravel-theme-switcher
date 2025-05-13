<?php

namespace Themes;

class ThemeManager
{
    protected array $palettes;
    protected string $selectedTheme;

    public function __construct()
    {
        $this->palettes = config('theme-palettes');
        $this->selectedTheme = array_key_first($this->palettes);
    }

    /**
     * Select a theme by name. Defaults to first theme if not found.
     */
    public function select(string $themeName): void
    {
        if (array_key_exists($themeName, $this->palettes)) {
            $this->selectedTheme = $themeName;
        } else {
            $this->selectedTheme = array_key_first($this->palettes);
        }
    }

    /**
     * Get the colors for the selected theme.
     */
    public function getColors(): array
    {
        return $this->palettes[$this->selectedTheme] ?? $this->palettes[array_key_first($this->palettes)];
    }
} 