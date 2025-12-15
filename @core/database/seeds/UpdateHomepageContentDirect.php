<?php
/**
 * Direct Database Update Script for Homepage Content
 * Run this script directly: php UpdateHomepageContentDirect.php
 * Or include it in a route for web execution
 */

require __DIR__ . '/../../vendor/autoload.php';

$app = require_once __DIR__ . '/../../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\PageBuilder;
use App\Page;
use App\StaticOption;
use Illuminate\Support\Facades\DB;

echo "=== Starting Direct Homepage Content Update ===\n\n";

// Content replacements
$replacements = [
    'Why Choose Qixer' => 'لماذا صيانة تك؟',
    'Qixer is a best service-based marketplace out there to help you get any task done conveniently. Thanks to our well built mobile app and website for making it even convenient for the users.' => 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.',
    'Why Our Marketplace' => 'لماذا صيانة تك؟',
    'Why Choose Us' => 'لماذا صيانة تك؟',
    'Get any tasks done by professionals' => 'صيانة تك - منصة خدمات الصيانة المنزلية والتقنية',
    'Order service you need. We have professionals ready to help.' => 'لدينا فريق فني متخصص لخدمتكم علي مدار اليوم مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.',
];

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

echo "Found homepage ID: {$homePageId}\n\n";

// Get all page builders
$pageBuilders = PageBuilder::where(function($query) use ($homePageId) {
        $query->where('addon_page_id', $homePageId)
              ->orWhere('addon_page_type', 'homepage')
              ->orWhere('addon_page_type', 'dynamic_page');
    })
    ->get();

echo "Found {$pageBuilders->count()} page builder addons.\n\n";

$updated = 0;
foreach ($pageBuilders as $pageBuilder) {
    try {
        $settings = @unserialize($pageBuilder->addon_settings);
        
        if ($settings && is_array($settings)) {
            $changed = false;
            $settingsJson = json_encode($settings);
            
            // Replace all occurrences
            foreach ($replacements as $oldText => $newText) {
                if (stripos($settingsJson, $oldText) !== false) {
                    $settingsJson = str_ireplace($oldText, $newText, $settingsJson);
                    $changed = true;
                }
            }
            
            if ($changed) {
                $newSettings = json_decode($settingsJson, true);
                if ($newSettings) {
                    // Recursively update the array
                    $newSettings = updateArrayRecursive($settings, $replacements);
                    $pageBuilder->addon_settings = serialize($newSettings);
                    $pageBuilder->save();
                    $updated++;
                    echo "  ✓ Updated: {$pageBuilder->addon_name}\n";
                }
            }
        }
    } catch (\Exception $e) {
        echo "  ✗ Error updating {$pageBuilder->addon_name}: " . $e->getMessage() . "\n";
    }
}

echo "\n✓ Updated {$updated} page builder addons.\n";
echo "\n=== Update Complete ===\n";

/**
 * Recursively update array values
 */
function updateArrayRecursive($data, $replacements) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                foreach ($replacements as $oldText => $newText) {
                    if (stripos($value, $oldText) !== false) {
                        $data[$key] = str_ireplace($oldText, $newText, $value);
                        break;
                    }
                }
            } elseif (is_array($value)) {
                $data[$key] = updateArrayRecursive($value, $replacements);
            }
        }
    } elseif (is_string($data)) {
        foreach ($replacements as $oldText => $newText) {
            if (stripos($data, $oldText) !== false) {
                return str_ireplace($oldText, $newText, $data);
            }
        }
    }
    
    return $data;
}

