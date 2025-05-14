<!-- Theme Switcher Button -->
<button class="theme-switcher-button" onclick="toggleThemePanel()">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="5"></circle>
        <line x1="12" y1="1" x2="12" y2="3"></line>
        <line x1="12" y1="21" x2="12" y2="23"></line>
        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
        <line x1="1" y1="12" x2="3" y2="12"></line>
        <line x1="21" y1="12" x2="23" y2="12"></line>
        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
    </svg>
</button>

<!-- Theme Switcher Panel -->
<div class="theme-switcher-panel" id="themePanel">
    <div class="theme-panel-header">
        <h3 class="theme-title">Theme Settings</h3>
        <button class="theme-close-button" onclick="toggleThemePanel()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <div class="theme-options">
        @foreach(config('theme-palettes.themes') as $key => $theme)
            <div class="theme-option" onclick="setTheme('{{ $key }}')">
                <div class="theme-preview">
                    <div class="theme-preview-main" style="background-color: {{ $theme['colors']['primary'] }}"></div>
                    <div class="theme-preview-colors">
                        <div class="theme-preview-color" style="background-color: {{ $theme['colors']['accent'] }}"></div>
                        <div class="theme-preview-color" style="background-color: {{ $theme['colors']['success'] }}"></div>
                        <div class="theme-preview-color" style="background-color: {{ $theme['colors']['warning'] }}"></div>
                        <div class="theme-preview-color" style="background-color: {{ $theme['colors']['error'] }}"></div>
                    </div>
                </div>
                <div class="theme-info">
                    <span class="theme-name">{{ $theme['name'] }}</span>
                    <div class="theme-colors">
                        <span class="theme-color-dot" style="background-color: {{ $theme['colors']['primary'] }}"></span>
                        <span class="theme-color-dot" style="background-color: {{ $theme['colors']['secondary'] }}"></span>
                        <span class="theme-color-dot" style="background-color: {{ $theme['colors']['accent'] }}"></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="theme-panel-footer">
        <button class="theme-reset-button" onclick="resetTheme()">
            Reset to Default
        </button>
    </div>
</div>

<script>
function toggleThemePanel() {
    const panel = document.getElementById('themePanel');
    panel.classList.toggle('active');
}

function resetTheme() {
    localStorage.removeItem('selectedTheme');
    setTheme('light');
}

// Close panel when clicking outside
document.addEventListener('click', function(event) {
    const panel = document.getElementById('themePanel');
    const button = document.querySelector('.theme-switcher-button');
    if (!panel.contains(event.target) && !button.contains(event.target)) {
        panel.classList.remove('active');
    }
});
</script> 