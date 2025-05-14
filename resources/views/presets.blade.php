@extends('theme-switcher::layouts.app')

@section('content')
<div class="presets-container">
    <div class="presets-header">
        <h2 class="text-primary">Theme Presets</h2>
        <p class="text-secondary">Save and load your favorite theme configurations</p>
    </div>

    <div class="presets-actions">
        <button class="btn-primary save-preset" data-bs-toggle="modal" data-bs-target="#savePresetModal">
            Save Current Preset
        </button>
    </div>

    <div class="presets-grid">
        @if($userPresets->isNotEmpty())
        <div class="presets-section">
            <h3 class="text-primary">Your Presets</h3>
            <div class="presets-list">
                @foreach($userPresets as $preset)
                <div class="preset-card" data-preset-id="{{ $preset->id }}">
                    <div class="preset-header">
                        <h4 class="text-primary">{{ $preset->name }}</h4>
                        <div class="preset-actions">
                            <button class="btn-secondary apply-preset" title="Apply Preset">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn-danger delete-preset" title="Delete Preset">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text-secondary">{{ $preset->description }}</p>
                    <div class="preset-meta">
                        <span class="text-secondary">
                            <i class="fas fa-clock"></i>
                            {{ $preset->created_at->diffForHumans() }}
                        </span>
                        @if($preset->is_public)
                        <span class="text-secondary">
                            <i class="fas fa-globe"></i>
                            Public
                        </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($publicPresets->isNotEmpty())
        <div class="presets-section">
            <h3 class="text-primary">Public Presets</h3>
            <div class="presets-list">
                @foreach($publicPresets as $preset)
                <div class="preset-card" data-preset-id="{{ $preset->id }}">
                    <div class="preset-header">
                        <h4 class="text-primary">{{ $preset->name }}</h4>
                        <div class="preset-actions">
                            <button class="btn-secondary apply-preset" title="Apply Preset">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text-secondary">{{ $preset->description }}</p>
                    <div class="preset-meta">
                        <span class="text-secondary">
                            <i class="fas fa-user"></i>
                            {{ $preset->created_by }}
                        </span>
                        <span class="text-secondary">
                            <i class="fas fa-clock"></i>
                            {{ $preset->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Save Preset Modal -->
<div class="modal fade" id="savePresetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Save Current Preset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="savePresetForm">
                    <div class="form-group">
                        <label class="text-secondary">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="text-secondary">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_public" class="form-check-input" id="isPublic">
                        <label class="form-check-label text-secondary" for="isPublic">
                            Make this preset public
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn-primary" id="savePresetBtn">Save Preset</button>
            </div>
        </div>
    </div>
</div>

<style>
.presets-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.presets-header {
    margin-bottom: 2rem;
    text-align: center;
}

.presets-actions {
    margin-bottom: 2rem;
    text-align: right;
}

.presets-grid {
    display: grid;
    gap: 2rem;
}

.presets-section {
    background: var(--theme-surface);
    border-radius: var(--theme-border-radius-medium);
    padding: 1.5rem;
    box-shadow: var(--theme-shadow-medium);
}

.presets-section h3 {
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--theme-border);
}

.presets-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1rem;
}

.preset-card {
    background: var(--theme-background);
    border-radius: var(--theme-border-radius-medium);
    padding: 1rem;
    box-shadow: var(--theme-shadow-small);
}

.preset-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

.preset-actions {
    display: flex;
    gap: 0.5rem;
}

.preset-meta {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
    font-size: 0.875rem;
}

.modal-content {
    background: var(--theme-surface);
    color: var(--theme-text);
}

.modal-header {
    border-bottom-color: var(--theme-border);
}

.modal-footer {
    border-top-color: var(--theme-border);
}

.form-control {
    background: var(--theme-background);
    border-color: var(--theme-border);
    color: var(--theme-text);
}

.form-control:focus {
    background: var(--theme-background);
    border-color: var(--theme-primary);
    color: var(--theme-text);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const presets = new ThemePresets();
    presets.init();
});

class ThemePresets {
    constructor() {
        this.modal = new bootstrap.Modal(document.getElementById('savePresetModal'));
    }

    init() {
        this.initializeSavePreset();
        this.initializePresetActions();
    }

    initializeSavePreset() {
        const saveBtn = document.getElementById('savePresetBtn');
        const form = document.getElementById('savePresetForm');

        saveBtn.addEventListener('click', () => this.savePreset(form));
    }

    initializePresetActions() {
        document.querySelectorAll('.apply-preset').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const card = e.target.closest('.preset-card');
                this.applyPreset(card.dataset.presetId);
            });
        });

        document.querySelectorAll('.delete-preset').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const card = e.target.closest('.preset-card');
                this.deletePreset(card.dataset.presetId);
            });
        });
    }

    async savePreset(form) {
        const formData = new FormData(form);
        const data = {
            name: formData.get('name'),
            description: formData.get('description'),
            is_public: formData.get('is_public') === 'on'
        };

        try {
            const response = await fetch('/theme-switcher/presets/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) throw new Error('Failed to save preset');

            const result = await response.json();
            this.showNotification('Preset saved successfully!', 'success');
            this.modal.hide();
            window.location.reload();
        } catch (error) {
            console.error('Error saving preset:', error);
            this.showNotification('Failed to save preset', 'error');
        }
    }

    async applyPreset(presetId) {
        try {
            const response = await fetch(`/theme-switcher/presets/apply/${presetId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) throw new Error('Failed to apply preset');

            const result = await response.json();
            this.showNotification('Preset applied successfully!', 'success');
            window.location.reload();
        } catch (error) {
            console.error('Error applying preset:', error);
            this.showNotification('Failed to apply preset', 'error');
        }
    }

    async deletePreset(presetId) {
        if (!confirm('Are you sure you want to delete this preset?')) return;

        try {
            const response = await fetch(`/theme-switcher/presets/delete/${presetId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) throw new Error('Failed to delete preset');

            const result = await response.json();
            this.showNotification('Preset deleted successfully!', 'success');
            window.location.reload();
        } catch (error) {
            console.error('Error deleting preset:', error);
            this.showNotification('Failed to delete preset', 'error');
        }
    }

    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease-in';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
}
</script>
@endsection 