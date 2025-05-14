document.addEventListener('DOMContentLoaded', function() {
    const storedTheme = localStorage.getItem('selectedTheme');
    if (storedTheme) {
        setTheme(storedTheme);
    }

    // Add active class to current theme
    const themeOptions = document.querySelectorAll('.theme-option');
    themeOptions.forEach(option => {
        const themeName = option.getAttribute('onclick').match(/'([^']+)'/)[1];
        if (themeName === storedTheme) {
            option.classList.add('active');
        }
    });
});

function setTheme(themeName) {
    const themes = {
        'sunset': ['#ffb5a7', '#fcd5ce', '#f8edeb', '#f9dcc4'],
        'forest': ['#355c4a', '#6b9080', '#a4c3b2', '#cce3de'],
        'ocean': ['#56cfe1', '#72efdd', '#80ffdb', '#5390d9'],
        'pastel': ['#ffd6e0', '#f6dfeb', '#dbe6e4', '#b8e0d2'],
        'midnight': ['#22223b', '#4a4e69', '#9a8c98', '#c9ada7']
    };

    const colors = themes[themeName];
    if (colors) {
        // Apply colors to specific elements
        document.documentElement.style.setProperty('--theme-primary', colors[0]);    // Base color
        document.documentElement.style.setProperty('--theme-secondary', colors[1]);  // Tint color
        document.documentElement.style.setProperty('--theme-accent', colors[2]);     // Midtone
        document.documentElement.style.setProperty('--theme-background', colors[3]); // Background

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