<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\PageBuilder;
use App\Page;
use App\MediaUpload;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

echo "Force updating About page image...\n";

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

// Get image info
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

// Check if file already exists
$existingFile = null;
$allMedia = MediaUpload::where('path', 'like', '%' . $imageNameSlug . '%')->get();
foreach ($allMedia as $media) {
    $mediaPath = $destinationPath . $media->path;
    if (File::exists($mediaPath)) {
        $existingFile = $media;
        break;
    }
}

if ($existingFile) {
    echo "Found existing media file: {$existingFile->id} - {$existingFile->path}\n";
    $imageId = $existingFile->id;
} else {
    // Copy new file
    File::copy($imagePath, $destinationPath . $imageDbName);
    echo "Copied image to: {$destinationPath}{$imageDbName}\n";
    
    // Create or update media upload record
    $mediaUpload = MediaUpload::updateOrCreate(
        [
            'title' => $imageName,
            'type' => 'admin',
        ],
        [
            'size' => $imageSize,
            'path' => $imageDbName,
            'alt' => 'فريق صيانة تك',
            'dimensions' => $imageInfo[0] . ' x ' . $imageInfo[1] . ' pixels',
        ]
    );
    
    $imageId = $mediaUpload->id;
    echo "Created/Updated media upload: {$imageId}\n";
}

// Get all page builders for About page
$pageBuilders = PageBuilder::where(function($query) use ($aboutPage) {
    $query->where('addon_page_id', $aboutPage->id)
          ->where('addon_name', 'AboutUs');
})->orWhere(function($query) use ($aboutPage) {
    $query->where('addon_page_type', 'dynamic_page')
          ->where('addon_page_id', $aboutPage->id)
          ->where('addon_name', 'AboutUs');
})->get();

if ($pageBuilders->isEmpty()) {
    echo "ERROR: No AboutUs addon found for About page!\n";
    echo "Creating new AboutUs addon...\n";
    
    $defaultSettings = [
        'title' => 'من نحن',
        'subtitle' => 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. نوفر خدمات شاملة في مجالات الكهرباء والسباكة والتكييف من خلال فريق من الفنيين المعتمدين والمحترفين.',
        'year' => '5',
        'button_title' => 'تواصل معنا',
        'button_link' => route('frontend.dynamic.page', 'contact'),
        'experience_show_hide' => 'on',
        'about_list_show_hide' => 'on',
        'image' => $imageId,
        'contact_page_contact_info_01' => [
            'benifits_' => [
                'خدمات صيانة شاملة (كهرباء، سباكة، تكييف)',
                'فنيون معتمدون ومحترفون في جميع التخصصات',
                'خدمة على مدار الساعة 24/7',
            ]
        ],
        'padding_top' => 100,
        'padding_bottom' => 100,
    ];
    
    PageBuilder::create([
        'addon_name' => 'AboutUs',
        'addon_type' => 'new',
        'addon_namespace' => 'App\PageBuilder\Addons\About\AboutUs',
        'addon_location' => 'dynamic_page',
        'addon_order' => 1,
        'addon_page_id' => $aboutPage->id,
        'addon_page_type' => 'dynamic_page',
        'addon_settings' => serialize($defaultSettings),
    ]);
    
    echo "Created new AboutUs addon with image ID: {$imageId}\n";
} else {
    foreach ($pageBuilders as $pageBuilder) {
        try {
            $settings = unserialize($pageBuilder->addon_settings);
            
            if ($settings && is_array($settings)) {
                // Force update image
                $oldImageId = $settings['image'] ?? null;
                $settings['image'] = $imageId;
                
                echo "Updating image from ID: {$oldImageId} to ID: {$imageId}\n";
                
                // Also update other settings
                $settings['title'] = 'من نحن';
                $settings['subtitle'] = 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. نوفر خدمات شاملة في مجالات الكهرباء والسباكة والتكييف من خلال فريق من الفنيين المعتمدين والمحترفين.';
                
                // Save
                $pageBuilder->addon_settings = serialize($settings);
                $pageBuilder->save();
                
                echo "Successfully updated AboutUs addon (ID: {$pageBuilder->id}) with image ID: {$imageId}\n";
                
                // Verify the update
                $verifySettings = unserialize($pageBuilder->fresh()->addon_settings);
                if (isset($verifySettings['image']) && $verifySettings['image'] == $imageId) {
                    echo "✓ Verification: Image ID correctly set to {$imageId}\n";
                } else {
                    echo "✗ WARNING: Image ID verification failed!\n";
                }
            }
        } catch (\Exception $e) {
            echo "ERROR updating addon: " . $e->getMessage() . "\n";
            echo "Stack trace: " . $e->getTraceAsString() . "\n";
        }
    }
}

// Clear cache
try {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    echo "Cache cleared successfully\n";
} catch (\Exception $e) {
    echo "WARNING: Could not clear cache: " . $e->getMessage() . "\n";
}

echo "\n=== Update Complete ===\n";
echo "Image ID: {$imageId}\n";
echo "Image Path: {$destinationPath}" . (isset($imageDbName) ? $imageDbName : ($existingFile ? $existingFile->path : 'N/A')) . "\n";
echo "You can review it at: http://localhost/SyanTeck/about\n";
echo "\nIf the image still doesn't appear, try:\n";
echo "1. Clear browser cache (Ctrl+F5)\n";
echo "2. Check if image file exists at: {$destinationPath}\n";
echo "3. Verify image ID {$imageId} in admin panel > Media Library\n";

