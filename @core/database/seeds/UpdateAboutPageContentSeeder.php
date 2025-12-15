<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\PageBuilder;
use App\Page;
use App\MediaUpload;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UpdateAboutPageContentSeeder extends Seeder
{
    /**
     * Translations mapping for About page
     */
    private $translations = [
        'About Us' => 'من نحن',
        'About' => 'من نحن',
        'About SyanTeck' => 'عن صيانة تك',
        'SyanTeck is an integrated electronic platform for managing home and technical maintenance services. The platform provides comprehensive solutions to connect clients with certified technicians with real-time order tracking, transparent pricing, electronic invoices, and digital warranties.' => 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.',
        'Our Mission' => 'مهمتنا',
        'Our Vision' => 'رؤيتنا',
        'Our Values' => 'قيمنا',
        'Why Choose Us' => 'لماذا تختارنا',
        '24/7 Support' => 'دعم على مدار الساعة',
        'Certified Technicians' => 'فنيون معتمدون',
        'Transparent Pricing' => 'أسعار شفافة',
        'Digital Warranty' => 'ضمان رقمي',
        'Quick Service' => 'خدمة سريعة',
        'Quality Guarantee' => 'ضمان الجودة',
    ];

    /**
     * Recursively update array values
     */
    private function updateArrayValues($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    // Check if value matches any translation key
                    if (isset($this->translations[$value])) {
                        $data[$key] = $this->translations[$value];
                    }
                } elseif (is_array($value)) {
                    $data[$key] = $this->updateArrayValues($value);
                }
            }
        } elseif (is_string($data)) {
            if (isset($this->translations[$data])) {
                return $this->translations[$data];
            }
        }
        
        return $data;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Starting About page content update...');

        // Get About page
        $aboutPage = Page::where('slug', 'about')->first();
        
        if (!$aboutPage) {
            $this->command->error('About page not found!');
            return;
        }

        $this->command->info("Found About page with ID: {$aboutPage->id}");

        // Update page title
        $aboutPage->title = 'من نحن';
        $aboutPage->save();
        $this->command->info("Updated page title to: من نحن");

        // Get all page builders for About page
        $pageBuilders = PageBuilder::where('addon_page_id', $aboutPage->id)
            ->orWhere(function($query) use ($aboutPage) {
                $query->where('addon_page_type', 'dynamic_page')
                      ->where('addon_page_id', $aboutPage->id);
            })
            ->get();

        $this->command->info("Found {$pageBuilders->count()} page builder addons to update.");

        // List of addons to keep (only AboutUs is needed for About page)
        $keepAddons = ['AboutUs'];
        
        $updated = 0;
        $deleted = 0;
        
        foreach ($pageBuilders as $pageBuilder) {
            // Delete unnecessary addons
            if (!in_array($pageBuilder->addon_name, $keepAddons)) {
                $pageBuilder->delete();
                $deleted++;
                $this->command->info("Deleted unnecessary addon: {$pageBuilder->addon_name}");
                continue;
            }
            
            try {
                $settings = unserialize($pageBuilder->addon_settings);
                
                if ($settings && is_array($settings)) {
                    $originalSettings = $settings;
                    $settings = $this->updateArrayValues($settings);
                    
                    // Update About Us addon with default content
                    if ($pageBuilder->addon_name === 'AboutUs') {
                        // Always update title and subtitle for AboutUs
                        $settings['title'] = 'من نحن';
                        $settings['subtitle'] = 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. نوفر خدمات شاملة في مجالات الكهرباء والسباكة والتكييف من خلال فريق من الفنيين المعتمدين والمحترفين. توفر المنصة حلولاً متكاملة لربط العملاء بالفنيين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.';
                        
                        // Update button
                        $settings['button_title'] = 'تواصل معنا';
                        if (empty($settings['button_link'])) {
                            $settings['button_link'] = route('frontend.dynamic.page', 'contact');
                        }
                        
                        // Update benefits list based on services offered
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
                        
                        // Update image with new team photo
                        $newImageId = $this->getOrCreateImageAttachment('Gemini_Generated_Image_kdeoj4kdeoj4kdeo.png');
                        if ($newImageId) {
                            $settings['image'] = $newImageId;
                            $this->command->info("Updated image to: Gemini_Generated_Image_kdeoj4kdeoj4kdeo.png (ID: {$newImageId})");
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
                    }
                    
                    // Always save
                    $pageBuilder->addon_settings = serialize($settings);
                    $pageBuilder->save();
                    $updated++;
                    $this->command->info("Updated: {$pageBuilder->addon_name}");
                }
            } catch (\Exception $e) {
                $this->command->warn("Error updating {$pageBuilder->addon_name}: " . $e->getMessage());
            }
        }

        // If no AboutUs addon found, create one with default content
        if ($pageBuilders->where('addon_name', 'AboutUs')->isEmpty()) {
            $this->command->info('No AboutUs addon found. Creating default AboutUs addon...');
            
            $defaultSettings = [
                'addon_name' => 'AboutUs',
                'addon_type' => 'new',
                'addon_namespace' => base64_encode('App\PageBuilder\Addons\About\AboutUs'),
                'addon_location' => 'dynamic_page',
                'addon_order' => 1,
                'addon_page_id' => $aboutPage->id,
                'addon_page_type' => 'dynamic_page',
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
                'image' => $this->getOrCreateImageAttachment('Gemini_Generated_Image_kdeoj4kdeoj4kdeo.png'),
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

            $this->command->info('Created default AboutUs addon with Arabic content.');
        }

        $this->command->info("Update complete! Updated {$updated} addons, deleted {$deleted} unnecessary addons.");
        $this->command->info('');
        $this->command->info('About page content has been updated successfully!');
        $this->command->info('You can review and customize it at: /admin/page-builder/dynamic-page/dynamic_page/' . $aboutPage->id);
    }
    
    /**
     * Get or create image attachment from file
     */
    private function getOrCreateImageAttachment($filename)
    {
        $imagePath = public_path('assets/frontend/img/' . $filename);
        
        if (!File::exists($imagePath)) {
            $this->command->warn("Image file not found: {$imagePath}");
            return null;
        }
        
        // Check if image already exists in media library
        $existingMedia = MediaUpload::where('path', 'like', '%' . $filename)
            ->orWhere('title', 'like', '%' . pathinfo($filename, PATHINFO_FILENAME) . '%')
            ->first();
        
        if ($existingMedia) {
            $this->command->info("Found existing media: {$existingMedia->id}");
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
            
            $this->command->info("Created new media upload: {$mediaUpload->id}");
            return $mediaUpload->id;
        } catch (\Exception $e) {
            $this->command->error("Error creating media upload: " . $e->getMessage());
            return null;
        }
    }
}

