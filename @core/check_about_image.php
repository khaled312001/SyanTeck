<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\PageBuilder;
use App\Page;
use App\MediaUpload;
use Illuminate\Support\Facades\File;

echo "Checking About page image...\n\n";

// Get About page
$aboutPage = Page::where('slug', 'about')->first();

if (!$aboutPage) {
    echo "ERROR: About page not found!\n";
    exit(1);
}

echo "About page ID: {$aboutPage->id}\n\n";

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

echo "AboutUs addon ID: {$pageBuilder->id}\n";

$settings = unserialize($pageBuilder->addon_settings);
$imageId = $settings['image'] ?? null;

echo "Image ID in settings: " . ($imageId ?? 'NULL') . "\n\n";

if (!$imageId) {
    echo "ERROR: No image ID found in settings!\n";
    exit(1);
}

// Get media upload
$mediaUpload = MediaUpload::find($imageId);

if (!$mediaUpload) {
    echo "ERROR: Media upload with ID {$imageId} not found in database!\n";
    exit(1);
}

echo "Media Upload Details:\n";
echo "  ID: {$mediaUpload->id}\n";
echo "  Title: {$mediaUpload->title}\n";
echo "  Path: {$mediaUpload->path}\n";
echo "  Size: {$mediaUpload->size} bytes\n";
echo "  Dimensions: {$mediaUpload->dimensions}\n";
echo "  Alt: {$mediaUpload->alt}\n\n";

// Check if file exists
$destinationPath = public_path('assets/uploads/media-uploader/');
$filePath = $destinationPath . $mediaUpload->path;

echo "Expected file path: {$filePath}\n";
echo "File exists: " . (File::exists($filePath) ? 'YES ✓' : 'NO ✗') . "\n\n";

if (File::exists($filePath)) {
    $fileSize = File::size($filePath);
    echo "File size: {$fileSize} bytes\n";
    echo "Database size: {$mediaUpload->size} bytes\n";
    echo "Match: " . ($fileSize == $mediaUpload->size ? 'YES ✓' : 'NO ✗') . "\n\n";
    
    // Get image URL
    $imageUrl = asset('assets/uploads/media-uploader/' . $mediaUpload->path);
    echo "Image URL: {$imageUrl}\n\n";
    
    // Test get_attachment_image_by_id
    $imageDetails = get_attachment_image_by_id($imageId, 'full', false);
    if ($imageDetails && !empty($imageDetails['img_url'])) {
        echo "get_attachment_image_by_id result:\n";
        echo "  img_url: {$imageDetails['img_url']}\n";
        echo "  img_alt: " . ($imageDetails['img_alt'] ?? 'N/A') . "\n\n";
    } else {
        echo "WARNING: get_attachment_image_by_id returned empty result!\n\n";
    }
    
    // Test render_image_markup_by_attachment_id
    $imageMarkup = render_image_markup_by_attachment_id($imageId);
    echo "render_image_markup_by_attachment_id result:\n";
    echo "  " . substr($imageMarkup, 0, 200) . "...\n\n";
} else {
    echo "ERROR: Image file does not exist at expected path!\n";
    echo "Please check if the file was copied correctly.\n";
}

echo "\n=== Check Complete ===\n";

