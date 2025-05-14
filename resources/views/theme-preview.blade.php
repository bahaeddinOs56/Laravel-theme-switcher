<div class="theme-preview-container">
    <div class="theme-preview-header">
        <h3 class="text-primary">Theme Preview</h3>
        <p class="text-secondary">Select a theme to preview its appearance</p>
    </div>

    <div class="theme-preview-grid">
        @foreach(config('themes.themes') as $key => $theme)
            <div class="theme-preview-card" data-theme="{{ $key }}">
                <div class="theme-preview-thumbnail" style="background: {{ $theme['colors']['background'] }}">
                    <!-- Preview Elements -->
                    <div class="preview-header" style="background: {{ $theme['colors']['surface'] }}"></div>
                    <div class="preview-content">
                        <div class="preview-button" style="background: {{ $theme['colors']['primary'] }}"></div>
                        <div class="preview-text" style="background: {{ $theme['colors']['text'] }}"></div>
                        <div class="preview-text" style="background: {{ $theme['colors']['text-secondary'] }}"></div>
                    </div>
                </div>
                <div class="theme-preview-info">
                    <h4 class="text-primary">{{ $theme['name'] }}</h4>
                    <p class="text-secondary">{{ $theme['description'] }}</p>
                </div>
                <div class="theme-preview-colors">
                    @foreach($theme['colors'] as $colorKey => $color)
                        <div class="color-dot" style="background: {{ $color }}" title="{{ $colorKey }}: {{ $color }}"></div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="theme-preview-live">
        <h4 class="text-primary">Live Preview</h4>
        <div class="preview-container">
            <div class="preview-nav" style="background: var(--theme-surface)">
                <div class="preview-nav-item" style="background: var(--theme-primary)"></div>
                <div class="preview-nav-item" style="background: var(--theme-text)"></div>
            </div>
            <div class="preview-main">
                <div class="preview-card" style="background: var(--theme-surface)">
                    <div class="preview-card-header" style="background: var(--theme-primary)"></div>
                    <div class="preview-card-content">
                        <div class="preview-text-line" style="background: var(--theme-text)"></div>
                        <div class="preview-text-line" style="background: var(--theme-text-secondary)"></div>
                        <div class="preview-button" style="background: var(--theme-primary)"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.theme-preview-container {
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.theme-preview-header {
    margin-bottom: 2rem;
    text-align: center;
}

.theme-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.theme-preview-card {
    background: var(--theme-surface);
    border-radius: var(--theme-border-radius-medium);
    overflow: hidden;
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
}

.theme-preview-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--theme-shadow-large);
}

.theme-preview-card.active {
    border-color: var(--theme-primary);
}

.theme-preview-thumbnail {
    height: 200px;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.preview-header {
    height: 20px;
    border-radius: var(--theme-border-radius-small);
}

.preview-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.preview-button {
    height: 30px;
    width: 100px;
    border-radius: var(--theme-border-radius-small);
}

.preview-text {
    height: 10px;
    width: 80%;
    border-radius: var(--theme-border-radius-small);
}

.theme-preview-info {
    padding: 1rem;
    border-top: 1px solid var(--theme-border);
}

.theme-preview-colors {
    display: flex;
    gap: 0.5rem;
    padding: 1rem;
    border-top: 1px solid var(--theme-border);
    flex-wrap: wrap;
}

.color-dot {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    cursor: pointer;
    transition: transform 0.2s ease;
}

.color-dot:hover {
    transform: scale(1.2);
}

.theme-preview-live {
    background: var(--theme-surface);
    border-radius: var(--theme-border-radius-medium);
    padding: 2rem;
    margin-top: 2rem;
}

.preview-container {
    margin-top: 1rem;
    border: 1px solid var(--theme-border);
    border-radius: var(--theme-border-radius-medium);
    overflow: hidden;
}

.preview-nav {
    height: 60px;
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0 1rem;
}

.preview-nav-item {
    width: 30px;
    height: 30px;
    border-radius: var(--theme-border-radius-small);
}

.preview-main {
    padding: 2rem;
    display: flex;
    justify-content: center;
}

.preview-card {
    width: 300px;
    border-radius: var(--theme-border-radius-medium);
    overflow: hidden;
}

.preview-card-header {
    height: 40px;
}

.preview-card-content {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.preview-text-line {
    height: 10px;
    border-radius: var(--theme-border-radius-small);
}

.preview-text-line:nth-child(2) {
    width: 80%;
}

.preview-button {
    height: 30px;
    width: 100px;
    border-radius: var(--theme-border-radius-small);
    margin-top: 0.5rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const themeCards = document.querySelectorAll('.theme-preview-card');
    const previewContainer = document.querySelector('.preview-container');

    themeCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove active class from all cards
            themeCards.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked card
            this.classList.add('active');
            
            // Get theme name
            const themeName = this.dataset.theme;
            
            // Update live preview
            updateLivePreview(themeName);
        });
    });

    function updateLivePreview(themeName) {
        // Add a class to trigger transition
        previewContainer.classList.add('theme-transitioning');
        
        // Remove the class after transition
        setTimeout(() => {
            previewContainer.classList.remove('theme-transitioning');
        }, 300);
    }
});
</script> 