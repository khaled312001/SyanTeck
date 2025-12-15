<?php
/**
 * Script to update Popular Services title in PageBuilder settings
 * Run this file directly: php update_popular_services_title.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\PageBuilder;
use App\Page;

echo "=== Updating Popular Services Title ===\n\n";

// Get homepage ID
$homePageId = get_static_option('home_page');
if (!$homePageId) {
    $homePage = Page::where('slug', 'home')
        ->orWhere('slug', 'homepage')
        ->orWhere('slug', 'index')
        ->first();
    $homePageId = $homePage ? $homePage->id : null;
}

if (!$homePageId) {
    echo "ERROR: Homepage not found!\n";
    exit(1);
}

echo "Homepage ID: {$homePageId}\n\n";

// Get all PopularService addons
$pageBuilders = PageBuilder::where(function($query) use ($homePageId) {
        $query->where('addon_page_id', $homePageId)
              ->orWhere('addon_page_type', 'homepage')
              ->orWhere('addon_page_type', 'dynamic_page');
    })
    ->whereIn('addon_name', ['PopularServiceThree', 'PopularService', 'PopularServiceTwo'])
    ->get();

echo "Found {$pageBuilders->count()} PopularService addons.\n\n";

$updated = 0;
foreach ($pageBuilders as $pageBuilder) {
    try {
        $settings = @unserialize($pageBuilder->addon_settings);
        
        if ($settings && is_array($settings)) {
            $oldTitle = $settings['title'] ?? '';
            
            // Update title if it contains old text
            if (isset($settings['title'])) {
                $title = $settings['title'];
                $needsUpdate = false;
                
                // Check various old title formats
                if (stripos($title, 'Popular Services') !== false || 
                    stripos($title, 'Popular Service') !== false ||
                    stripos($title, 'الخدمات الشائعة') !== false ||
                    stripos($title, 'الخدمات الأكثر') !== false ||
                    stripos($title, 'الخدمات المتاحة') !== false ||
                    $title === 'Popular Services' ||
                    $title === 'Popular Service' ||
                    $title === 'الخدمات الشائعة') {
                    $settings['title'] = 'الخدمات الأكثر طلباً';
                    $needsUpdate = true;
                    echo "  → Updating title: '{$oldTitle}' → 'الخدمات الأكثر طلباً'\n";
                }
                
                if ($needsUpdate) {
                    $pageBuilder->addon_settings = serialize($settings);
                    $pageBuilder->save();
                    $updated++;
                    echo "  ✓ Updated: {$pageBuilder->addon_name} (ID: {$pageBuilder->id})\n";
                } else {
                    echo "  - No update needed: {$pageBuilder->addon_name} (Title: '{$oldTitle}')\n";
                }
            } else {
                echo "  - No title field found: {$pageBuilder->addon_name}\n";
            }
        }
    } catch (\Exception $e) {
        echo "  ✗ Error updating {$pageBuilder->addon_name}: " . $e->getMessage() . "\n";
    }
}

echo "\n=== Update Complete ===\n";
echo "Updated {$updated} addons.\n";

