<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\PageBuilder;
use App\Page;
use App\MediaUpload;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

echo "Updating About page image...\n";

// Get About page
$aboutPage = Page::where('slug', 'about')->first();

if (!$aboutPage) {
    echo "ERROR: About page not found!\n";
    exit(1);
}

echo "Found About page with ID: {$aboutPage->id}\n";

// Image path
$imagePath = 'C:/xampp/htdocs/SyanTeck/assets/frontend/img/Gemini_Generated_Image_kdeoj4kdeoj4kdeo.png';

if (!File::exists($imagePath)) {
    echo "ERROR: Image file not found at: {$imagePath}\n";
    exit(1);
}

echo "Image file found: {$imagePath}\n";

// Check if image already exists in media library
$existingMedia = MediaUpload::where('path', 'like', '%Gemini_Generated_Image%')
    ->orWhere('title', 'like', '%Gemini_Generated_Image%')
    ->first();

$imageId = null;

if ($existingMedia) {
    echo "Found existing media: {$existingMedia->id}\n";
    $imageId = $existingMedia->id;
} else {
    // Create new media upload entry
    try {
        $imageInfo = getimagesize($imagePath);
        $imageSize = File::size($imagePath);
        $imageExtension = File::extension($imagePath);
        $imageName = 'Gemini_Generated_Image_kdeoj4kdeoj4kdeo';
        $imageNameSlug = Str::slug($imageName);
        $imageDbName = $imageNameSlug . time() . '.' . $imageExtension;
        
        // Copy file to media upload directory
        $destinationPath = public_path('assets/uploads/media-uploader/');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
        
        File::copy($imagePath, $destinationPath . $imageDbName);
        
        // Create media upload record
        $mediaUpload = MediaUpload::create([
            'title' => $imageName,
            'size' => $imageSize,
            'path' => $imageDbName,
            'alt' => 'فريق صيانة تك',
            'dimensions' => $imageInfo[0] . ' x ' . $imageInfo[1] . ' pixels',
            'type' => 'admin',
        ]);
        
        $imageId = $mediaUpload->id;
        echo "Created new media upload: {$imageId}\n";
    } catch (\Exception $e) {
        echo "ERROR creating media upload: " . $e->getMessage() . "\n";
        exit(1);
    }
}

// Get all page builders for About page
$pageBuilders = PageBuilder::where('addon_page_id', $aboutPage->id)
    ->where('addon_name', 'AboutUs')
    ->get();

if ($pageBuilders->isEmpty()) {
    echo "ERROR: No AboutUs addon found for About page!\n";
    exit(1);
}

foreach ($pageBuilders as $pageBuilder) {
    try {
        $settings = unserialize($pageBuilder->addon_settings);
        
        if ($settings && is_array($settings)) {
            // Force update image
            $settings['image'] = $imageId;
            echo "Setting image ID to: {$imageId}\n";
            
            // Save
            $pageBuilder->addon_settings = serialize($settings);
            $pageBuilder->save();
            echo "Successfully updated AboutUs addon with image ID: {$imageId}\n";
        }
    } catch (\Exception $e) {
        echo "ERROR updating addon: " . $e->getMessage() . "\n";
    }
}

echo "\nImage update complete!\n";
echo "You can review it at: http://localhost/SyanTeck/about\n";

