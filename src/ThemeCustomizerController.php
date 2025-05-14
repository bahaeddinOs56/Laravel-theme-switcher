<?php

namespace Bahae\LaravelThemeSwitcher;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class ThemeCustomizerController extends Controller
{
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    /**
     * Show the theme customizer page
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('theme-switcher::theme-customizer');
    }

    /**
     * Save a custom theme
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $themeData = $request->validate([
            'colors' => 'required|array',
            'typography' => 'required|array',
            'shadows' => 'required|array',
            'borders' => 'required|array',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000'
        ]);

        try {
            // Generate a unique theme key
            $themeKey = 'custom_' . strtolower(str_replace(' ', '_', $themeData['name']));
            
            // Add the theme to the configuration
            $themes = config('themes.themes', []);
            $themes[$themeKey] = [
                'name' => $themeData['name'],
                'description' => $themeData['description'] ?? 'Custom theme',
                'colors' => $themeData['colors'],
                'typography' => $themeData['typography'],
                'shadows' => $themeData['shadows'],
                'borders' => $themeData['borders']
            ];

            // Save the updated configuration
            $this->saveThemeConfig($themes);

            // Generate CSS variables for the new theme
            $css = $this->theme->generateCssVariables($themeKey);

            // Save the CSS to a file
            $this->saveThemeCss($themeKey, $css);

            return response()->json([
                'success' => true,
                'message' => 'Theme saved successfully',
                'theme' => $themeKey
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Save the theme configuration
     *
     * @param array $themes
     * @return void
     */
    protected function saveThemeConfig(array $themes)
    {
        $configPath = config_path('themes.php');
        $content = "<?php\n\nreturn [\n    'themes' => " . var_export($themes, true) . ",\n];";
        file_put_contents($configPath, $content);
    }

    /**
     * Save the theme CSS
     *
     * @param string $themeKey
     * @param string $css
     * @return void
     */
    protected function saveThemeCss(string $themeKey, string $css)
    {
        $cssPath = public_path("css/themes/{$themeKey}.css");
        if (!file_exists(dirname($cssPath))) {
            mkdir(dirname($cssPath), 0755, true);
        }
        file_put_contents($cssPath, $css);
    }

    /**
     * Delete a custom theme
     *
     * @param string $themeKey
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $themeKey)
    {
        if (!str_starts_with($themeKey, 'custom_')) {
            return response()->json([
                'error' => 'Only custom themes can be deleted'
            ], 400);
        }

        try {
            // Remove the theme from configuration
            $themes = config('themes.themes', []);
            unset($themes[$themeKey]);
            $this->saveThemeConfig($themes);

            // Delete the CSS file
            $cssPath = public_path("css/themes/{$themeKey}.css");
            if (file_exists($cssPath)) {
                unlink($cssPath);
            }

            return response()->json([
                'success' => true,
                'message' => 'Theme deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
} 