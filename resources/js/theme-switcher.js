class ThemeSwitcher {
    constructor() {
        this.currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
        this.previewMode = false;
        this.previewTheme = null;
        this.init();
    }

    init() {
        // Initialize theme switcher
        this.initializeThemeSwitcher();
        
        // Initialize theme preview if on preview page
        if (document.querySelector('.theme-preview-container')) {
            this.initializeThemePreview();
        }
    }

    initializeThemeSwitcher() {
        const switcher = document.querySelector('.theme-switcher');
        if (!switcher) return;

        const themeSelect = switcher.querySelector('select');
        if (themeSelect) {
            themeSelect.value = this.currentTheme;
            themeSelect.addEventListener('change', (e) => this.switchTheme(e.target.value));
        }
    }

    initializeThemePreview() {
        const themeCards = document.querySelectorAll('.theme-preview-card');
        const previewContainer = document.querySelector('.preview-container');

        themeCards.forEach(card => {
            card.addEventListener('click', () => {
                const themeName = card.dataset.theme;
                this.previewTheme(themeName);
            });
        });

        // Add apply button to preview container
        const applyButton = document.createElement('button');
        applyButton.className = 'btn-primary';
        applyButton.textContent = 'Apply Theme';
        applyButton.style.marginTop = '1rem';
        applyButton.addEventListener('click', () => this.applyTheme());
        previewContainer.parentElement.appendChild(applyButton);
    }

    async previewTheme(themeName) {
        try {
            const response = await fetch('/theme-switcher/preview', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ theme: themeName })
            });

            if (!response.ok) throw new Error('Failed to preview theme');

            const data = await response.json();
            this.previewMode = true;
            this.previewTheme = themeName;

            // Update active card
            document.querySelectorAll('.theme-preview-card').forEach(card => {
                card.classList.toggle('active', card.dataset.theme === themeName);
            });

            // Apply preview CSS
            this.applyThemeStyles(data.css);
        } catch (error) {
            console.error('Error previewing theme:', error);
        }
    }

    async applyTheme() {
        if (!this.previewTheme) return;

        try {
            const response = await fetch('/theme-switcher/apply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ theme: this.previewTheme })
            });

            if (!response.ok) throw new Error('Failed to apply theme');

            const data = await response.json();
            this.currentTheme = this.previewTheme;
            this.previewMode = false;
            this.previewTheme = null;

            // Update theme switcher if present
            const themeSelect = document.querySelector('.theme-switcher select');
            if (themeSelect) {
                themeSelect.value = this.currentTheme;
            }

            // Show success message
            this.showNotification('Theme applied successfully!', 'success');
        } catch (error) {
            console.error('Error applying theme:', error);
            this.showNotification('Failed to apply theme', 'error');
        }
    }

    async switchTheme(themeName) {
        try {
            const response = await fetch('/theme-switcher/apply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ theme: themeName })
            });

            if (!response.ok) throw new Error('Failed to switch theme');

            const data = await response.json();
            this.currentTheme = themeName;
            document.documentElement.setAttribute('data-theme', themeName);

            // Show success message
            this.showNotification('Theme switched successfully!', 'success');
        } catch (error) {
            console.error('Error switching theme:', error);
            this.showNotification('Failed to switch theme', 'error');
        }
    }

    applyThemeStyles(css) {
        let styleElement = document.getElementById('theme-preview-styles');
        if (!styleElement) {
            styleElement = document.createElement('style');
            styleElement.id = 'theme-preview-styles';
            document.head.appendChild(styleElement);
        }
        styleElement.textContent = css;
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;

        document.body.appendChild(notification);

        // Add styles for notification
        const style = document.createElement('style');
        style.textContent = `
            .notification {
                position: fixed;
                bottom: 20px;
                right: 20px;
                padding: 1rem 2rem;
                border-radius: var(--theme-border-radius-medium);
                color: white;
                font-weight: 500;
                z-index: 1000;
                animation: slideIn 0.3s ease-out;
            }
            .notification.success { background: var(--theme-success); }
            .notification.error { background: var(--theme-error); }
            .notification.info { background: var(--theme-primary); }
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(style);

        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease-in';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
}

// Initialize theme switcher when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.themeSwitcher = new ThemeSwitcher();
}); 