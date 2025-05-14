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
    <h3 class="theme-title">Choose Theme</h3>
    <div class="theme-options">
        <div class="theme-option" onclick="setTheme('sunset')">
            <div class="theme-preview">
                <div class="theme-preview-color" style="background-color: #ffb5a7"></div>
                <div class="theme-preview-color" style="background-color: #fcd5ce"></div>
                <div class="theme-preview-color" style="background-color: #f8edeb"></div>
                <div class="theme-preview-color" style="background-color: #f9dcc4"></div>
            </div>
            <span>Sunset</span>
        </div>
        <div class="theme-option" onclick="setTheme('forest')">
            <div class="theme-preview">
                <div class="theme-preview-color" style="background-color: #355c4a"></div>
                <div class="theme-preview-color" style="background-color: #6b9080"></div>
                <div class="theme-preview-color" style="background-color: #a4c3b2"></div>
                <div class="theme-preview-color" style="background-color: #cce3de"></div>
            </div>
            <span>Forest</span>
        </div>
        <div class="theme-option" onclick="setTheme('ocean')">
            <div class="theme-preview">
                <div class="theme-preview-color" style="background-color: #56cfe1"></div>
                <div class="theme-preview-color" style="background-color: #72efdd"></div>
                <div class="theme-preview-color" style="background-color: #80ffdb"></div>
                <div class="theme-preview-color" style="background-color: #5390d9"></div>
            </div>
            <span>Ocean</span>
        </div>
        <div class="theme-option" onclick="setTheme('pastel')">
            <div class="theme-preview">
                <div class="theme-preview-color" style="background-color: #ffd6e0"></div>
                <div class="theme-preview-color" style="background-color: #f6dfeb"></div>
                <div class="theme-preview-color" style="background-color: #dbe6e4"></div>
                <div class="theme-preview-color" style="background-color: #b8e0d2"></div>
            </div>
            <span>Pastel</span>
        </div>
        <div class="theme-option" onclick="setTheme('midnight')">
            <div class="theme-preview">
                <div class="theme-preview-color" style="background-color: #22223b"></div>
                <div class="theme-preview-color" style="background-color: #4a4e69"></div>
                <div class="theme-preview-color" style="background-color: #9a8c98"></div>
                <div class="theme-preview-color" style="background-color: #c9ada7"></div>
            </div>
            <span>Midnight</span>
        </div>
    </div>
</div>

<script>
function toggleThemePanel() {
    const panel = document.getElementById('themePanel');
    panel.classList.toggle('active');
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