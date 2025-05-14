<?php

namespace Bahae\LaravelThemeSwitcher;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

class ThemeAnalyticsController extends Controller
{
    /**
     * Show the analytics dashboard
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $stats = Cache::remember('theme_analytics_stats', 3600, function () {
            return ThemeAnalytics::getAllThemesStats();
        });

        return view('theme-switcher::analytics', compact('stats'));
    }

    /**
     * Get analytics data for a specific theme
     *
     * @param string $themeKey
     * @return \Illuminate\Http\JsonResponse
     */
    public function getThemeStats(string $themeKey)
    {
        $stats = Cache::remember("theme_stats_{$themeKey}", 3600, function () use ($themeKey) {
            return ThemeAnalytics::getThemeStats($themeKey);
        });

        return response()->json($stats);
    }

    /**
     * Get usage trends for a specific theme
     *
     * @param string $themeKey
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getThemeTrends(string $themeKey, Request $request)
    {
        $days = $request->input('days', 30);
        $trends = Cache::remember("theme_trends_{$themeKey}_{$days}", 3600, function () use ($themeKey, $days) {
            return ThemeAnalytics::getThemeTrends($themeKey, $days);
        });

        return response()->json($trends);
    }

    /**
     * Track theme switch
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function trackSwitch(Request $request)
    {
        $themeKey = $request->input('theme_key');
        
        if (!config("themes.themes.{$themeKey}")) {
            return response()->json(['error' => 'Invalid theme'], 400);
        }

        ThemeAnalytics::create([
            'theme_key' => $themeKey,
            'user_agent' => $request->userAgent(),
            'ip_address' => $request->ip(),
            'session_id' => session()->getId(),
            'switched_at' => now()
        ]);

        // Clear cache
        Cache::forget('theme_analytics_stats');
        Cache::forget("theme_stats_{$themeKey}");

        return response()->json(['success' => true]);
    }
} 