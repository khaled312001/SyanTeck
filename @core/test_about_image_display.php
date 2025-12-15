<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\PageBuilder;
use App\Page;

echo "Testing About page image display...\n\n";

// Get About page
$aboutPage = Page::where('slug', 'about')->first();

if (!$aboutPage) {
    echo "ERROR: About page not found!\n";
    exit(1);
}

// Get AboutUs addon
$pageBuilder = PageBuilder::where(function($query) use ($aboutPage) {
    $query->where('addon_page_id', $aboutPage->id)
          ->where('addon_name', 'AboutUs');
})->orWhere(function($query) use ($aboutPage) {
    $query->where('addon_page_type', 'dynamic_page')
          ->where('addon_page_id', $aboutPage->id)
          ->where('addon_name', 'AboutUs');
})->first();

if (!$pageBuilder) {
    echo "ERROR: AboutUs addon not found!\n";
    exit(1);
}

$settings = unserialize($pageBuilder->addon_settings);

echo "Settings check:\n";
echo "  Image ID: " . ($settings['image'] ?? 'NULL') . "\n";
echo "  Title: " . ($settings['title'] ?? 'NULL') . "\n";
echo "  Year: " . ($settings['year'] ?? 'NULL') . "\n\n";

// Test render_image_markup_by_attachment_id directly
if (!empty($settings['image'])) {
    $imageMarkup = render_image_markup_by_attachment_id($settings['image']);
    echo "Image markup result:\n";
    echo $imageMarkup . "\n\n";
    
    // Extract URL from markup
    if (preg_match('/src="([^"]+)"/', $imageMarkup, $matches)) {
        $imageUrl = $matches[1];
        echo "Image URL extracted: {$imageUrl}\n";
        
        // Check if URL is accessible
        $ch = curl_init($imageUrl);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        echo "HTTP Status Code: {$httpCode}\n";
        if ($httpCode == 200) {
            echo "✓ Image URL is accessible\n";
        } else {
            echo "✗ Image URL is NOT accessible (HTTP {$httpCode})\n";
        }
    }
} else {
    echo "ERROR: Image ID is empty in settings!\n";
}

// Clear all caches
echo "\nClearing caches...\n";
try {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    echo "✓ Application cache cleared\n";
    
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    echo "✓ View cache cleared\n";
    
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    echo "✓ Config cache cleared\n";
    
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    echo "✓ Route cache cleared\n";
} catch (\Exception $e) {
    echo "WARNING: Could not clear some caches: " . $e->getMessage() . "\n";
}

echo "\n=== Test Complete ===\n";

