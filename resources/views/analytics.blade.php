@extends('theme-switcher::layouts.app')

@section('content')
<div class="analytics-container">
    <div class="analytics-header">
        <h2 class="text-primary">Theme Analytics</h2>
        <p class="text-secondary">Track theme usage and user preferences</p>
    </div>

    <div class="analytics-grid">
        @foreach($stats as $themeKey => $theme)
        <div class="analytics-card" data-theme-key="{{ $themeKey }}">
            <div class="card-header">
                <h3 class="text-primary">{{ $theme['name'] }}</h3>
                <div class="theme-key text-secondary">{{ $themeKey }}</div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value">{{ $theme['stats']['total'] }}</div>
                    <div class="stat-label">Total Switches</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $theme['stats']['today'] }}</div>
                    <div class="stat-label">Today</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $theme['stats']['this_week'] }}</div>
                    <div class="stat-label">This Week</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $theme['stats']['this_month'] }}</div>
                    <div class="stat-label">This Month</div>
                </div>
            </div>

            <div class="trend-chart">
                <canvas id="trend-{{ $themeKey }}"></canvas>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.analytics-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.analytics-header {
    margin-bottom: 2rem;
    text-align: center;
}

.analytics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.analytics-card {
    background: var(--theme-surface);
    border-radius: var(--theme-border-radius-medium);
    padding: 1.5rem;
    box-shadow: var(--theme-shadow-medium);
}

.card-header {
    margin-bottom: 1.5rem;
}

.theme-key {
    font-size: 0.875rem;
    opacity: 0.7;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: var(--theme-background);
    border-radius: var(--theme-border-radius-small);
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--theme-primary);
}

.stat-label {
    font-size: 0.875rem;
    color: var(--theme-text-secondary);
    margin-top: 0.25rem;
}

.trend-chart {
    height: 200px;
    margin-top: 1rem;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const analytics = new ThemeAnalytics();
    analytics.init();
});

class ThemeAnalytics {
    constructor() {
        this.charts = {};
    }

    init() {
        this.loadThemeStats();
        this.initializeCharts();
    }

    async loadThemeStats() {
        const cards = document.querySelectorAll('.analytics-card');
        
        for (const card of cards) {
            const themeKey = card.dataset.themeKey;
            const stats = await this.fetchThemeStats(themeKey);
            this.updateStats(card, stats);
            this.updateChart(themeKey);
        }
    }

    async fetchThemeStats(themeKey) {
        try {
            const response = await fetch(`/theme-switcher/analytics/stats/${themeKey}`);
            return await response.json();
        } catch (error) {
            console.error('Error fetching theme stats:', error);
            return null;
        }
    }

    updateStats(card, stats) {
        if (!stats) return;

        const values = card.querySelectorAll('.stat-value');
        values[0].textContent = stats.total;
        values[1].textContent = stats.today;
        values[2].textContent = stats.this_week;
        values[3].textContent = stats.this_month;
    }

    async initializeCharts() {
        const cards = document.querySelectorAll('.analytics-card');
        
        for (const card of cards) {
            const themeKey = card.dataset.themeKey;
            const canvas = card.querySelector('canvas');
            
            this.charts[themeKey] = new Chart(canvas, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Theme Switches',
                        data: [],
                        borderColor: 'var(--theme-primary)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'var(--theme-border)'
                            },
                            ticks: {
                                color: 'var(--theme-text-secondary)'
                            }
                        },
                        x: {
                            grid: {
                                color: 'var(--theme-border)'
                            },
                            ticks: {
                                color: 'var(--theme-text-secondary)'
                            }
                        }
                    }
                }
            });
        }
    }

    async updateChart(themeKey) {
        try {
            const response = await fetch(`/theme-switcher/analytics/trends/${themeKey}`);
            const trends = await response.json();
            
            const chart = this.charts[themeKey];
            chart.data.labels = trends.map(t => t.date);
            chart.data.datasets[0].data = trends.map(t => t.count);
            chart.update();
        } catch (error) {
            console.error('Error updating chart:', error);
        }
    }
}
</script>
@endsection 