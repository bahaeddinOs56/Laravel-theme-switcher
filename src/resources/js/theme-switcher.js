document.addEventListener('DOMContentLoaded', function() {
    const storedTheme = localStorage.getItem('selectedTheme');
    if (storedTheme) {
        setTheme(storedTheme);
    }

    const themePreviews = document.querySelectorAll('[onclick^="setTheme"]');
    themePreviews.forEach(preview => {
        preview.addEventListener('click', function() {
            const themeName = this.getAttribute('onclick').match(/'([^']+)'/)[1];
            setTheme(themeName);
        });
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

        // Apply colors to specific elements
        const sidebar = document.querySelector('.theme-sidebar');
        if (sidebar) {
            sidebar.style.background = `linear-gradient(to bottom, ${colors[0]}, ${colors[1]})`;
        }

        const buttons = document.querySelectorAll('.theme-button');
        buttons.forEach(button => {
            button.style.backgroundColor = colors[2];
            button.style.color = colors[3];
        });

        document.body.style.backgroundColor = colors[3];

        localStorage.setItem('selectedTheme', themeName);
    }
} 