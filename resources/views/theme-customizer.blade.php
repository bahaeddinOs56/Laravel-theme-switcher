<div class="theme-customizer-container">
    <div class="theme-customizer-header">
        <h3 class="text-primary">Theme Customizer</h3>
        <p class="text-secondary">Customize your theme's appearance</p>
    </div>

    <div class="theme-customizer-content">
        <div class="customizer-sidebar">
            <div class="customizer-section">
                <h4 class="text-primary">Colors</h4>
                <div class="color-pickers">
                    @foreach(config('themes.themes.light.colors') as $colorKey => $color)
                        <div class="color-picker-group">
                            <label class="text-secondary">{{ ucfirst(str_replace('-', ' ', $colorKey)) }}</label>
                            <div class="color-picker-wrapper">
                                <input type="color" 
                                       class="color-picker" 
                                       data-color-key="{{ $colorKey }}"
                                       value="{{ $color }}"
                                       title="{{ $colorKey }}: {{ $color }}">
                                <input type="text" 
                                       class="color-value" 
                                       value="{{ $color }}"
                                       data-color-key="{{ $colorKey }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="customizer-section">
                <h4 class="text-primary">Typography</h4>
                <div class="typography-controls">
                    <div class="control-group">
                        <label class="text-secondary">Font Family</label>
                        <select class="font-family-select">
                            <option value="system-ui">System UI</option>
                            <option value="Inter">Inter</option>
                            <option value="Roboto">Roboto</option>
                            <option value="Open Sans">Open Sans</option>
                        </select>
                    </div>
                    <div class="control-group">
                        <label class="text-secondary">Base Font Size</label>
                        <input type="range" 
                               class="font-size-slider" 
                               min="12" 
                               max="20" 
                               value="16"
                               data-unit="px">
                        <span class="font-size-value">16px</span>
                    </div>
                </div>
            </div>

            <div class="customizer-section">
                <h4 class="text-primary">Shadows & Borders</h4>
                <div class="shadow-controls">
                    <div class="control-group">
                        <label class="text-secondary">Shadow Intensity</label>
                        <input type="range" 
                               class="shadow-slider" 
                               min="0" 
                               max="100" 
                               value="50">
                        <span class="shadow-value">50%</span>
                    </div>
                    <div class="control-group">
                        <label class="text-secondary">Border Radius</label>
                        <input type="range" 
                               class="radius-slider" 
                               min="0" 
                               max="24" 
                               value="8"
                               data-unit="px">
                        <span class="radius-value">8px</span>
                    </div>
                </div>
            </div>

            <div class="customizer-actions">
                <button class="btn-primary save-theme">Save Theme</button>
                <button class="btn-secondary reset-theme">Reset to Default</button>
            </div>
        </div>

        <div class="customizer-preview">
            <div class="preview-header">
                <h4 class="text-primary">Live Preview</h4>
                <div class="preview-controls">
                    <button class="btn-secondary preview-mobile">Mobile</button>
                    <button class="btn-secondary preview-tablet">Tablet</button>
                    <button class="btn-secondary preview-desktop active">Desktop</button>
                </div>
            </div>
            <div class="preview-frame">
                <div class="preview-content">
                    <nav class="preview-nav">
                        <div class="nav-brand">Brand</div>
                        <div class="nav-items">
                            <div class="nav-item">Home</div>
                            <div class="nav-item">About</div>
                            <div class="nav-item">Contact</div>
                        </div>
                    </nav>
                    <main class="preview-main">
                        <div class="preview-card">
                            <h2 class="text-primary">Card Title</h2>
                            <p class="text-secondary">This is a sample card to preview your theme customization.</p>
                            <button class="btn-primary">Action Button</button>
                        </div>
                        <div class="preview-form">
                            <div class="form-group">
                                <label class="text-secondary">Input Label</label>
                                <input type="text" class="form-input" placeholder="Enter text...">
                            </div>
                            <div class="form-group">
                                <label class="text-secondary">Select Option</label>
                                <select class="form-select">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.theme-customizer-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.theme-customizer-header {
    margin-bottom: 2rem;
    text-align: center;
}

.theme-customizer-content {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 2rem;
    min-height: 600px;
}

.customizer-sidebar {
    background: var(--theme-surface);
    border-radius: var(--theme-border-radius-medium);
    padding: 1.5rem;
    box-shadow: var(--theme-shadow-medium);
}

.customizer-section {
    margin-bottom: 2rem;
}

.customizer-section h4 {
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--theme-border);
}

.color-pickers {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.color-picker-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.color-picker-wrapper {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.color-picker {
    width: 40px;
    height: 40px;
    padding: 0;
    border: none;
    border-radius: var(--theme-border-radius-small);
    cursor: pointer;
}

.color-value {
    flex: 1;
    padding: 0.5rem;
    border: 1px solid var(--theme-border);
    border-radius: var(--theme-border-radius-small);
    background: var(--theme-background);
    color: var(--theme-text);
}

.typography-controls,
.shadow-controls {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.control-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

select,
input[type="range"] {
    padding: 0.5rem;
    border: 1px solid var(--theme-border);
    border-radius: var(--theme-border-radius-small);
    background: var(--theme-background);
    color: var(--theme-text);
}

.customizer-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.customizer-preview {
    background: var(--theme-surface);
    border-radius: var(--theme-border-radius-medium);
    padding: 1.5rem;
    box-shadow: var(--theme-shadow-medium);
}

.preview-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.preview-controls {
    display: flex;
    gap: 0.5rem;
}

.preview-frame {
    border: 1px solid var(--theme-border);
    border-radius: var(--theme-border-radius-medium);
    overflow: hidden;
    background: var(--theme-background);
}

.preview-content {
    min-height: 500px;
}

.preview-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: var(--theme-surface);
    border-bottom: 1px solid var(--theme-border);
}

.nav-items {
    display: flex;
    gap: 1rem;
}

.preview-main {
    padding: 2rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.preview-card {
    padding: 1.5rem;
    background: var(--theme-surface);
    border-radius: var(--theme-border-radius-medium);
    box-shadow: var(--theme-shadow-medium);
}

.preview-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-input,
.form-select {
    padding: 0.5rem;
    border: 1px solid var(--theme-border);
    border-radius: var(--theme-border-radius-small);
    background: var(--theme-background);
    color: var(--theme-text);
}

/* Responsive Preview */
.preview-frame.mobile {
    max-width: 375px;
    margin: 0 auto;
}

.preview-frame.tablet {
    max-width: 768px;
    margin: 0 auto;
}

.preview-frame.desktop {
    width: 100%;
}

/* Active States */
.preview-controls button.active {
    background: var(--theme-primary);
    color: white;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const customizer = new ThemeCustomizer();
    customizer.init();
});

class ThemeCustomizer {
    constructor() {
        this.currentTheme = {};
        this.previewFrame = document.querySelector('.preview-frame');
        this.initTheme();
    }

    init() {
        this.initializeColorPickers();
        this.initializeTypographyControls();
        this.initializeShadowControls();
        this.initializePreviewControls();
        this.initializeActionButtons();
    }

    initTheme() {
        // Initialize with default theme
        this.currentTheme = {
            colors: { ...config('themes.themes.light.colors') },
            typography: {
                fontFamily: 'system-ui',
                fontSize: '16px'
            },
            shadows: {
                intensity: 50
            },
            borders: {
                radius: '8px'
            }
        };
    }

    initializeColorPickers() {
        const colorPickers = document.querySelectorAll('.color-picker');
        const colorValues = document.querySelectorAll('.color-value');

        colorPickers.forEach(picker => {
            picker.addEventListener('input', (e) => {
                const colorKey = e.target.dataset.colorKey;
                const colorValue = e.target.value;
                this.updateColor(colorKey, colorValue);
            });
        });

        colorValues.forEach(input => {
            input.addEventListener('change', (e) => {
                const colorKey = e.target.dataset.colorKey;
                const colorValue = e.target.value;
                this.updateColor(colorKey, colorValue);
            });
        });
    }

    initializeTypographyControls() {
        const fontFamilySelect = document.querySelector('.font-family-select');
        const fontSizeSlider = document.querySelector('.font-size-slider');
        const fontSizeValue = document.querySelector('.font-size-value');

        fontFamilySelect.addEventListener('change', (e) => {
            this.updateTypography('fontFamily', e.target.value);
        });

        fontSizeSlider.addEventListener('input', (e) => {
            const value = `${e.target.value}px`;
            fontSizeValue.textContent = value;
            this.updateTypography('fontSize', value);
        });
    }

    initializeShadowControls() {
        const shadowSlider = document.querySelector('.shadow-slider');
        const shadowValue = document.querySelector('.shadow-value');
        const radiusSlider = document.querySelector('.radius-slider');
        const radiusValue = document.querySelector('.radius-value');

        shadowSlider.addEventListener('input', (e) => {
            const value = `${e.target.value}%`;
            shadowValue.textContent = value;
            this.updateShadow('intensity', e.target.value);
        });

        radiusSlider.addEventListener('input', (e) => {
            const value = `${e.target.value}px`;
            radiusValue.textContent = value;
            this.updateBorder('radius', value);
        });
    }

    initializePreviewControls() {
        const previewButtons = document.querySelectorAll('.preview-controls button');
        
        previewButtons.forEach(button => {
            button.addEventListener('click', () => {
                previewButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                const size = button.classList.contains('preview-mobile') ? 'mobile' :
                            button.classList.contains('preview-tablet') ? 'tablet' : 'desktop';
                
                this.previewFrame.className = `preview-frame ${size}`;
            });
        });
    }

    initializeActionButtons() {
        const saveButton = document.querySelector('.save-theme');
        const resetButton = document.querySelector('.reset-theme');

        saveButton.addEventListener('click', () => this.saveTheme());
        resetButton.addEventListener('click', () => this.resetTheme());
    }

    updateColor(key, value) {
        this.currentTheme.colors[key] = value;
        document.documentElement.style.setProperty(`--theme-${key}`, value);
        
        // Update color picker and input
        const picker = document.querySelector(`.color-picker[data-color-key="${key}"]`);
        const input = document.querySelector(`.color-value[data-color-key="${key}"]`);
        if (picker) picker.value = value;
        if (input) input.value = value;
    }

    updateTypography(key, value) {
        this.currentTheme.typography[key] = value;
        if (key === 'fontFamily') {
            document.documentElement.style.setProperty('--theme-font-family', value);
        } else if (key === 'fontSize') {
            document.documentElement.style.setProperty('--theme-font-size', value);
        }
    }

    updateShadow(key, value) {
        this.currentTheme.shadows[key] = value;
        const intensity = value / 100;
        document.documentElement.style.setProperty('--theme-shadow-intensity', intensity);
    }

    updateBorder(key, value) {
        this.currentTheme.borders[key] = value;
        document.documentElement.style.setProperty('--theme-border-radius', value);
    }

    async saveTheme() {
        try {
            const response = await fetch('/theme-switcher/save-custom', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(this.currentTheme)
            });

            if (!response.ok) throw new Error('Failed to save theme');

            const data = await response.json();
            this.showNotification('Theme saved successfully!', 'success');
        } catch (error) {
            console.error('Error saving theme:', error);
            this.showNotification('Failed to save theme', 'error');
        }
    }

    resetTheme() {
        this.initTheme();
        this.applyTheme(this.currentTheme);
        this.showNotification('Theme reset to default', 'info');
    }

    applyTheme(theme) {
        // Apply colors
        Object.entries(theme.colors).forEach(([key, value]) => {
            this.updateColor(key, value);
        });

        // Apply typography
        Object.entries(theme.typography).forEach(([key, value]) => {
            this.updateTypography(key, value);
        });

        // Apply shadows
        Object.entries(theme.shadows).forEach(([key, value]) => {
            this.updateShadow(key, value);
        });

        // Apply borders
        Object.entries(theme.borders).forEach(([key, value]) => {
            this.updateBorder(key, value);
        });
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
</script> 