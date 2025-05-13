<div class="relative inline-block text-left">
    <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="theme-switcher-button">
        Themes
    </button>

    <div class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" id="theme-dropdown" role="menu" aria-orientation="vertical" aria-labelledby="theme-switcher-button">
        <div class="py-1" role="none">
            <h3 class="px-4 py-2 text-sm font-medium text-gray-700">Featured Themes</h3>
            <div class="px-4 py-2">
                <div class="flex space-x-2">
                    <div class="w-12 h-6 rounded cursor-pointer" style="background: linear-gradient(to right, #ffb5a7, #fcd5ce, #f8edeb, #f9dcc4);" onclick="setTheme('sunset')"></div>
                    <div class="w-12 h-6 rounded cursor-pointer" style="background: linear-gradient(to right, #355c4a, #6b9080, #a4c3b2, #cce3de);" onclick="setTheme('forest')"></div>
                    <div class="w-12 h-6 rounded cursor-pointer" style="background: linear-gradient(to right, #56cfe1, #72efdd, #80ffdb, #5390d9);" onclick="setTheme('ocean')"></div>
                </div>
            </div>
            <h3 class="px-4 py-2 text-sm font-medium text-gray-700">More Themes</h3>
            <div class="px-4 py-2 max-h-40 overflow-y-auto">
                <div class="flex space-x-2 mb-2">
                    <div class="w-12 h-6 rounded cursor-pointer" style="background: linear-gradient(to right, #ffd6e0, #f6dfeb, #dbe6e4, #b8e0d2);" onclick="setTheme('pastel')"></div>
                </div>
                <div class="flex space-x-2 mb-2">
                    <div class="w-12 h-6 rounded cursor-pointer" style="background: linear-gradient(to right, #22223b, #4a4e69, #9a8c98, #c9ada7);" onclick="setTheme('midnight')"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('theme-switcher-button').addEventListener('click', function() {
        document.getElementById('theme-dropdown').classList.toggle('hidden');
    });
</script> 