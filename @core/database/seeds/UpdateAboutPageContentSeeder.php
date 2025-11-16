<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\PageBuilder;
use App\Page;

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
                        $settings['subtitle'] = 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.';
                        
                        // Update button
                        $settings['button_title'] = 'تواصل معنا';
                        if (empty($settings['button_link'])) {
                            $settings['button_link'] = route('frontend.dynamic.page', 'contact');
                        }
                        
                        // Update benefits list
                        if (!isset($settings['contact_page_contact_info_01'])) {
                            $settings['contact_page_contact_info_01'] = [];
                        }
                        $settings['contact_page_contact_info_01']['benifits_'] = [
                            'خدمة على مدار الساعة',
                            'فنيون معتمدون ومحترفون',
                            'أسعار شفافة وعدالة',
                            'ضمان رقمي لكل خدمة',
                            'تتبع مباشر للطلبات',
                        ];
                        
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
                'subtitle' => 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.',
                'year' => '5',
                'button_title' => 'تواصل معنا',
                'button_link' => route('frontend.dynamic.page', 'contact'),
                'experience_show_hide' => 'on',
                'about_list_show_hide' => 'on',
                'contact_page_contact_info_01' => [
                    'benifits_' => [
                        'خدمة على مدار الساعة',
                        'فنيون معتمدون ومحترفون',
                        'أسعار شفافة وعدالة',
                        'ضمان رقمي لكل خدمة',
                        'تتبع مباشر للطلبات',
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

            $this->command->info('Created default AboutUs addon with Arabic content.');
        }

        $this->command->info("Update complete! Updated {$updated} addons, deleted {$deleted} unnecessary addons.");
        $this->command->info('');
        $this->command->info('About page content has been updated successfully!');
        $this->command->info('You can review and customize it at: /admin/page-builder/dynamic-page/dynamic_page/' . $aboutPage->id);
    }
}

