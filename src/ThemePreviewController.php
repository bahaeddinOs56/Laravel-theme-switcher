<?php

namespace Bahae\LaravelThemeSwitcher;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ThemePreviewController extends Controller
{
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    /**
     * Show the theme preview page
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('theme-switcher::theme-preview');
    }

    /**
     * Preview a theme without saving it
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function preview(Request $request)
    {
        $themeName = $request->input('theme');
        
        if (!array_key_exists($themeName, config('themes.themes', []))) {
            return response()->json(['error' => 'Theme not found'], 404);
        }

        // Generate CSS variables for the preview theme
        $css = $this->theme->generateCssVariables($themeName);

        return response()->json([
            'css' => $css,
            'theme' => $themeName
        ]);
    }

    /**
     * Apply the selected theme
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apply(Request $request)
    {
        $themeName = $request->input('theme');
        
        try {
            $this->theme->setTheme($themeName);
            
            return response()->json([
                'success' => true,
                'message' => 'Theme applied successfully',
                'theme' => $themeName
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
} 