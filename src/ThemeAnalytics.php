<?php

namespace Bahae\LaravelThemeSwitcher;

use Illuminate\Database\Eloquent\Model;

class ThemeAnalytics extends Model
{
    protected $fillable = [
        'theme_key',
        'user_agent',
        'ip_address',
        'session_id',
        'switched_at'
    ];

    protected $casts = [
        'switched_at' => 'datetime'
    ];

    /**
     * Get analytics data for a specific theme
     *
     * @param string $themeKey
     * @return array
     */
    public static function getThemeStats(string $themeKey): array
    {
        $total = self::where('theme_key', $themeKey)->count();
        $today = self::where('theme_key', $themeKey)
            ->whereDate('switched_at', today())
            ->count();
        $thisWeek = self::where('theme_key', $themeKey)
            ->whereBetween('switched_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
        $thisMonth = self::where('theme_key', $themeKey)
            ->whereBetween('switched_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        return [
            'total' => $total,
            'today' => $today,
            'this_week' => $thisWeek,
            'this_month' => $thisMonth
        ];
    }

    /**
     * Get all themes usage statistics
     *
     * @return array
     */
    public static function getAllThemesStats(): array
    {
        $stats = [];
        $themes = config('themes.themes', []);

        foreach ($themes as $themeKey => $theme) {
            $stats[$themeKey] = [
                'name' => $theme['name'],
                'stats' => self::getThemeStats($themeKey)
            ];
        }

        return $stats;
    }

    /**
     * Get usage trends for a specific theme
     *
     * @param string $themeKey
     * @param int $days
     * @return array
     */
    public static function getThemeTrends(string $themeKey, int $days = 30): array
    {
        $trends = [];
        $startDate = now()->subDays($days);

        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i);
            $count = self::where('theme_key', $themeKey)
                ->whereDate('switched_at', $date)
                ->count();

            $trends[] = [
                'date' => $date->format('Y-m-d'),
                'count' => $count
            ];
        }

        return $trends;
    }
} 