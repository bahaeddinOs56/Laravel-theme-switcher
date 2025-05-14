<?php

namespace Bahae\LaravelThemeSwitcher;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ThemePresetController extends Controller
{
    /**
     * Show the presets page
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $theme = app(Theme::class);
        $currentTheme = $theme->getCurrentTheme();
        
        $publicPresets = ThemePreset::getPublicPresets($currentTheme);
        $userPresets = Auth::check() 
            ? ThemePreset::getUserPresets($currentTheme, Auth::id())
            : collect();

        return view('theme-switcher::presets', compact('publicPresets', 'userPresets'));
    }

    /**
     * Save a new preset
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_public' => 'boolean'
        ]);

        try {
            $preset = ThemePreset::createFromCurrent(
                $data['name'],
                $data['description'] ?? null,
                $data['is_public'] ?? false,
                Auth::id()
            );

            return response()->json([
                'success' => true,
                'message' => 'Preset saved successfully',
                'preset' => $preset
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Apply a preset
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function apply(int $id)
    {
        try {
            $preset = ThemePreset::findOrFail($id);
            
            // Check if user has access to the preset
            if (!$preset->is_public && $preset->created_by !== Auth::id()) {
                return response()->json([
                    'error' => 'You do not have access to this preset'
                ], 403);
            }

            $preset->apply();

            return response()->json([
                'success' => true,
                'message' => 'Preset applied successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Delete a preset
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id)
    {
        try {
            $preset = ThemePreset::findOrFail($id);
            
            // Check if user owns the preset
            if ($preset->created_by !== Auth::id()) {
                return response()->json([
                    'error' => 'You do not have permission to delete this preset'
                ], 403);
            }

            $preset->delete();

            return response()->json([
                'success' => true,
                'message' => 'Preset deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
} 