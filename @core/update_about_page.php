<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\PageBuilder;
use App\Page;
use App\MediaUpload;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

echo "Starting About page content update...\n";

// Get About page
$aboutPage = Page::where('slug', 'about')->first();

if (!$aboutPage) {
    echo "ERROR: About page not found!\n";
    exit(1);
}

echo "Found About page with ID: {$aboutPage->id}\n";

// Update page title
$aboutPage->title = 'من نحن';
$aboutPage->save();
echo "Updated page title to: من نحن\n";

// Function to get or create image attachment
function getOrCreateImageAttachment($filename) {
    // Try multiple possible paths
    $possiblePaths = [
        base_path('assets/frontend/img/' . $filename),
        base_path('../assets/frontend/img/' . $filename),
        public_path('../assets/frontend/img/' . $filename),
        dirname(base_path()) . '/assets/frontend/img/' . $filename,
        'C:/xampp/htdocs/SyanTeck/assets/frontend/img/' . $filename,
    ];

    $imagePath = null;
    foreach ($possiblePaths as $path) {
        if (File::exists($path)) {
            $imagePath = $path;
            break;
        }
    }

    if (!$imagePath) {
        echo "WARNING: Image file not found. Tried paths:\n";
        foreach ($possiblePaths as $path) {
            echo "  - {$path}\n";
        }
        return null;
    }

    if (!File::exists($imagePath)) {
        echo "WARNING: Image file not found: {$imagePath}\n";
        return null;
    }

    // Check if image already exists in media library
    $existingMedia = MediaUpload::where('path', 'like', '%' . $filename)
        ->orWhere('title', 'like', '%' . pathinfo($filename, PATHINFO_FILENAME) . '%')
        ->first();

    if ($existingMedia) {
        echo "Found existing media: {$existingMedia->id}\n";
        return $existingMedia->id;
    }

    // Create new media upload entry
    try {
        $imageInfo = getimagesize($imagePath);
        $imageSize = File::size($imagePath);
        $imageExtension = File::extension($imagePath);
        $imageName = pathinfo($filename, PATHINFO_FILENAME);
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

        echo "Created new media upload: {$mediaUpload->id}\n";
        return $mediaUpload->id;
    } catch (\Exception $e) {
        echo "ERROR creating media upload: " . $e->getMessage() . "\n";
        return null;
    }
}

// Get all page builders for About page
$pageBuilders = PageBuilder::where('addon_page_id', $aboutPage->id)
    ->orWhere(function($query) use ($aboutPage) {
        $query->where('addon_page_type', 'dynamic_page')
              ->where('addon_page_id', $aboutPage->id);
    })
    ->get();

echo "Found {$pageBuilders->count()} page builder addons to update.\n";

$updated = 0;
$deleted = 0;

foreach ($pageBuilders as $pageBuilder) {
    // Delete unnecessary addons (keep only AboutUs)
    if ($pageBuilder->addon_name !== 'AboutUs') {
        $pageBuilder->delete();
        $deleted++;
        echo "Deleted unnecessary addon: {$pageBuilder->addon_name}\n";
        continue;
    }

    try {
        $settings = unserialize($pageBuilder->addon_settings);

        if ($settings && is_array($settings)) {
            // Update About Us addon with new content
            $settings['title'] = 'من نحن';
            $settings['subtitle'] = 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. نوفر خدمات شاملة في مجالات الكهرباء والسباكة والتكييف من خلال فريق من الفنيين المعتمدين والمحترفين. توفر المنصة حلولاً متكاملة لربط العملاء بالفنيين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.';

            // Update button
            $settings['button_title'] = 'تواصل معنا';
            if (empty($settings['button_link'])) {
                $settings['button_link'] = route('frontend.dynamic.page', 'contact');
            }

            // Update benefits list based on services
            if (!isset($settings['contact_page_contact_info_01'])) {
                $settings['contact_page_contact_info_01'] = [];
            }
            $settings['contact_page_contact_info_01']['benifits_'] = [
                'خدمات صيانة شاملة (كهرباء، سباكة، تكييف)',
                'فنيون معتمدون ومحترفون في جميع التخصصات',
                'خدمة على مدار الساعة 24/7',
                'أسعار شفافة ومحوكمة',
                'ضمان رقمي لكل خدمة',
                'تتبع مباشر للطلبات في الوقت الفعلي',
            ];

            // Update image with new team photo using hardcoded image path as instructed
            $newImageId = getOrCreateImageAttachment('Gemini_Generated_Image_kdeoj4kdeoj4kdeo.png');
            if ($newImageId) {
                $settings['image'] = $newImageId;
                echo "Updated image to: Gemini_Generated_Image_kdeoj4kdeoj4kdeo.png (ID: {$newImageId})\n";
            }

            // Enable experience and benefits list
            $settings['experience_show_hide'] = 'on';
            $settings['about_list_show_hide'] = 'on';

            // Set year of experience
            if (empty($settings['year'])) {
                $settings['year'] = '5';
            }

            // Set padding
            if (empty($settings['padding_top'])) {
                $settings['padding_top'] = 100;
            }
            if (empty($settings['padding_bottom'])) {
                $settings['padding_bottom'] = 100;
            }

            // Save
            $pageBuilder->addon_settings = serialize($settings);
            $pageBuilder->save();
            $updated++;
            echo "Updated: {$pageBuilder->addon_name}\n";
        }
    } catch (\Exception $e) {
        echo "WARNING: Error updating {$pageBuilder->addon_name}: " . $e->getMessage() . "\n";
    }
}

// If no AboutUs addon found, create one
if ($pageBuilders->where('addon_name', 'AboutUs')->isEmpty()) {
    echo "No AboutUs addon found. Creating default AboutUs addon...\n";

    $newImageId = getOrCreateImageAttachment('Gemini_Generated_Image_kdeoj4kdeoj4kdeo.png');

    $defaultSettings = [
        'title' => 'من نحن',
        'subtitle' => 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. نوفر خدمات شاملة في مجالات الكهرباء والسباكة والتكييف من خلال فريق من الفنيين المعتمدين والمحترفين. توفر المنصة حلولاً متكاملة لربط العملاء بالفنيين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.',
        'year' => '5',
        'button_title' => 'تواصل معنا',
        'button_link' => route('frontend.dynamic.page', 'contact'),
        'experience_show_hide' => 'on',
        'about_list_show_hide' => 'on',
        'contact_page_contact_info_01' => [
            'benifits_' => [
                'خدمات صيانة شاملة (كهرباء، سباكة، تكييف)',
                'فنيون معتمدون ومحترفون في جميع التخصصات',
                'خدمة على مدار الساعة 24/7',
                'أسعار شفافة ومحوكمة',
                'ضمان رقمي لكل خدمة',
                'تتبع مباشر للطلبات في الوقت الفعلي',
            ]
        ],
        'padding_top' => 100,
        'padding_bottom' => 100,
    ];

    if ($newImageId) {
        $defaultSettings['image'] = $newImageId;
    }

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

    echo "Created default AboutUs addon with Arabic content.\n";
}

echo "\nUpdate complete! Updated {$updated} addons, deleted {$deleted} unnecessary addons.\n";
echo "About page content has been updated successfully!\n";
echo "You can review it at: http://localhost/SyanTeck/about\n";

