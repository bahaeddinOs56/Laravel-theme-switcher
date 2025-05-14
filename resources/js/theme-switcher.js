document.addEventListener('DOMContentLoaded', function() {
    const storedTheme = localStorage.getItem('selectedTheme');
    if (storedTheme) {
        setTheme(storedTheme);
    } else {
        setTheme('light'); // Set default theme
    }

    // Add active class to current theme
    const themeOptions = document.querySelectorAll('.theme-option');
    themeOptions.forEach(option => {
        const themeName = option.getAttribute('onclick').match(/'([^']+)'/)[1];
        if (themeName === storedTheme || (!storedTheme && themeName === 'light')) {
            option.classList.add('active');
        }
    });
});

function setTheme(themeName) {
    const themes = {
        'light': {
            primary: '#ffffff',
            secondary: '#f3f4f6',
            accent: '#3b82f6',
            text: '#1f2937',
            'text-light': '#6b7280',
            border: '#e5e7eb',
            success: '#10b981',
            warning: '#f59e0b',
            error: '#ef4444',
            info: '#3b82f6'
        },
        'dark': {
            primary: '#1f2937',
            secondary: '#111827',
            accent: '#60a5fa',
            text: '#f9fafb',
            'text-light': '#d1d5db',
            border: '#374151',
            success: '#34d399',
            warning: '#fbbf24',
            error: '#f87171',
            info: '#60a5fa'
        },
        'blue': {
            primary: '#1e40af',
            secondary: '#1e3a8a',
            accent: '#60a5fa',
            text: '#ffffff',
            'text-light': '#bfdbfe',
            border: '#3b82f6',
            success: '#34d399',
            warning: '#fbbf24',
            error: '#f87171',
            info: '#60a5fa'
        },
        'green': {
            primary: '#065f46',
            secondary: '#064e3b',
            accent: '#34d399',
            text: '#ffffff',
            'text-light': '#a7f3d0',
            border: '#10b981',
            success: '#34d399',
            warning: '#fbbf24',
            error: '#f87171',
            info: '#60a5fa'
        },
        'purple': {
            primary: '#5b21b6',
            secondary: '#4c1d95',
            accent: '#a78bfa',
            text: '#ffffff',
            'text-light': '#c4b5fd',
            border: '#8b5cf6',
            success: '#34d399',
            warning: '#fbbf24',
            error: '#f87171',
            info: '#60a5fa'
        }
    };

    const colors = themes[themeName];
    if (colors) {
        // Apply colors to CSS variables
        Object.entries(colors).forEach(([key, value]) => {
            document.documentElement.style.setProperty(`--theme-${key}`, value);
        });

        // Update active theme in UI
        const themeOptions = document.querySelectorAll('.theme-option');
        themeOptions.forEach(option => {
            option.classList.remove('active');
            const optionTheme = option.getAttribute('onclick').match(/'([^']+)'/)[1];
            if (optionTheme === themeName) {
                option.classList.add('active');
            }
        });

        // Close the theme panel
        const panel = document.getElementById('themePanel');
        if (panel) {
            panel.classList.remove('active');
        }

        localStorage.setItem('selectedTheme', themeName);
    }
} 