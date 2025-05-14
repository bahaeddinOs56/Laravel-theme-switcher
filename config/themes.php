<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Theme
    |--------------------------------------------------------------------------
    |
    | This is the default theme that will be used when no theme is selected.
    |
    */
    'default' => 'light',

    /*
    |--------------------------------------------------------------------------
    | Theme Storage
    |--------------------------------------------------------------------------
    |
    | This option controls how themes are stored and persisted.
    | Options: 'session', 'cookie', 'database'
    |
    */
    'storage' => 'session',

    /*
    |--------------------------------------------------------------------------
    | Available Themes
    |--------------------------------------------------------------------------
    |
    | Define all available themes and their properties.
    |
    */
    'themes' => [
        'light' => [
            'name' => 'Minimal Light',
            'description' => 'A clean and minimal light theme with subtle accents',
            'colors' => [
                'background' => '#ffffff',
                'surface' => '#f3f4f6',
                'surface-hover' => '#e5e7eb',
                'primary' => '#3b82f6',
                'primary-hover' => '#2563eb',
                'secondary' => '#60a5fa',
                'secondary-hover' => '#3b82f6',
                'text' => '#1f2937',
                'text-secondary' => '#4b5563',
                'border' => '#e5e7eb',
                'success' => '#10b981',
                'warning' => '#f59e0b',
                'error' => '#ef4444',
            ],
            'shadows' => [
                'small' => '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
                'medium' => '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
                'large' => '0 10px 15px -3px rgba(0, 0, 0, 0.1)',
            ],
            'typography' => [
                'font-family' => 'Inter, system-ui, sans-serif',
                'font-size-base' => '1rem',
                'line-height-base' => '1.5',
            ],
            'border-radius' => [
                'small' => '0.25rem',
                'medium' => '0.5rem',
                'large' => '1rem',
            ],
        ],
        'dark' => [
            'name' => 'Modern Dark',
            'description' => 'A sophisticated dark theme with modern aesthetics',
            'colors' => [
                'background' => '#1a1a1a',
                'surface' => '#2d2d2d',
                'surface-hover' => '#404040',
                'primary' => '#3b82f6',
                'primary-hover' => '#60a5fa',
                'secondary' => '#60a5fa',
                'secondary-hover' => '#93c5fd',
                'text' => '#ffffff',
                'text-secondary' => '#e5e7eb',
                'border' => '#404040',
                'success' => '#059669',
                'warning' => '#d97706',
                'error' => '#dc2626',
            ],
            'shadows' => [
                'small' => '0 1px 2px 0 rgba(0, 0, 0, 0.3)',
                'medium' => '0 4px 6px -1px rgba(0, 0, 0, 0.4)',
                'large' => '0 10px 15px -3px rgba(0, 0, 0, 0.4)',
            ],
            'typography' => [
                'font-family' => 'Inter, system-ui, sans-serif',
                'font-size-base' => '1rem',
                'line-height-base' => '1.5',
            ],
            'border-radius' => [
                'small' => '0.25rem',
                'medium' => '0.5rem',
                'large' => '1rem',
            ],
        ],
        'ocean' => [
            'name' => 'Ocean Breeze',
            'description' => 'A refreshing theme inspired by ocean waves',
            'colors' => [
                'background' => 'linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%)',
                'surface' => 'rgba(255, 255, 255, 0.1)',
                'surface-hover' => 'rgba(255, 255, 255, 0.15)',
                'primary' => '#60a5fa',
                'primary-hover' => '#93c5fd',
                'secondary' => '#93c5fd',
                'secondary-hover' => '#bfdbfe',
                'text' => '#ffffff',
                'text-secondary' => '#e5e7eb',
                'border' => 'rgba(255, 255, 255, 0.2)',
                'success' => '#34d399',
                'warning' => '#fbbf24',
                'error' => '#f87171',
            ],
            'shadows' => [
                'small' => '0 1px 2px 0 rgba(0, 0, 0, 0.2)',
                'medium' => '0 4px 6px -1px rgba(0, 0, 0, 0.3)',
                'large' => '0 10px 15px -3px rgba(0, 0, 0, 0.3)',
            ],
            'typography' => [
                'font-family' => 'Inter, system-ui, sans-serif',
                'font-size-base' => '1rem',
                'line-height-base' => '1.5',
            ],
            'border-radius' => [
                'small' => '0.25rem',
                'medium' => '0.5rem',
                'large' => '1rem',
            ],
            'effects' => [
                'wave-animation' => true,
                'glass-effect' => true,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme Variables
    |--------------------------------------------------------------------------
    |
    | CSS variables that will be generated for each theme.
    |
    */
    'variables' => [
        '--theme-background',
        '--theme-surface',
        '--theme-surface-hover',
        '--theme-primary',
        '--theme-primary-hover',
        '--theme-secondary',
        '--theme-secondary-hover',
        '--theme-text',
        '--theme-text-secondary',
        '--theme-border',
        '--theme-success',
        '--theme-warning',
        '--theme-error',
        '--theme-shadow-small',
        '--theme-shadow-medium',
        '--theme-shadow-large',
        '--theme-font-family',
        '--theme-font-size-base',
        '--theme-line-height-base',
        '--theme-border-radius-small',
        '--theme-border-radius-medium',
        '--theme-border-radius-large',
    ],
]; 