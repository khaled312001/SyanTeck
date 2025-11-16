<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\PageBuilder;
use App\Page;
use App\Widgets;

class UpdateAllSectionsContentSeeder extends Seeder
{
    /**
     * Content mapping for all sections
     */
    private $contentMapping = [
        // Best Taskers / Top Technicians
        'Best Taskers of the Month' => 'أفضل الفنيين لهذا الشهر',
        'Top Technicians' => 'أفضل الفنيين',
        'Seller Profile List Two' => 'أفضل الفنيين لهذا الشهر',
        
        // Become Seller/Technician Section
        'Join with us as a service provider and earn a good remuneration' => 'انضم إلينا كمقدم خدمة واكسب راتباً جيداً',
        'Get regular works' => 'احصل على أعمال منتظمة',
        'Generous service buyers' => 'عملاء كرماء',
        'Start As Seller' => 'انضم كفني',
        'Start As Technician' => 'انضم كفني',
        'Become A Seller' => 'كن فني',
        'Join As A Seller' => 'انضم كفني',
        
        // Customer Stories
        'Thriving to serve our customers the best. Hear our stories as told by customers.' => 'نسعى جاهدين لخدمة عملائنا بأفضل طريقة. استمع إلى قصصنا كما رواها العملاء.',
        'Customer Stories' => 'قصص العملاء',
        'What Our Customers Say' => 'ماذا يقول عملاؤنا',
        'Customer Review: 01' => 'قصص العملاء',
        
        // Blog Section
        'Read our daily Blogs' => 'اقرأ مدونتنا',
        'Latest Blog Posts' => 'أحدث المقالات',
        'Read More' => 'اقرأ المزيد',
        'Explore More' => 'استكشف المزيد',
        'Recent Blog: 03' => 'أحدث المقالات',
        
        // Footer
        'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less.' => 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.',
        'Community' => 'المجتمع',
        'Become A Buyer' => 'كن عميل',
        'Privacy Policy' => 'سياسة الخصوصية',
        'Terms & Conditions' => 'الشروط والأحكام',
    ];

    /**
     * Recursively update array values
     */
    private function updateArrayValues($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    // Check for exact match
                    if (isset($this->contentMapping[$value])) {
                        $data[$key] = $this->contentMapping[$value];
                    } else {
                        // Check for partial matches
                        foreach ($this->contentMapping as $oldText => $newText) {
                            if (stripos($value, $oldText) !== false && strlen($oldText) > 10) {
                                $data[$key] = str_ireplace($oldText, $newText, $value);
                                break;
                            }
                        }
                    }
                } elseif (is_array($value)) {
                    $data[$key] = $this->updateArrayValues($value);
                }
            }
        } elseif (is_string($data)) {
            if (isset($this->contentMapping[$data])) {
                return $this->contentMapping[$data];
            } else {
                foreach ($this->contentMapping as $oldText => $newText) {
                    if (stripos($data, $oldText) !== false && strlen($oldText) > 10) {
                        return str_ireplace($oldText, $newText, $data);
                    }
                }
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
        $this->command->info('=== Starting All Sections Content Update ===');
        $this->command->info('');

        // Step 1: Update Page Builder Content
        $this->updatePageBuilderContent();

        // Step 2: Update Footer Widgets
        $this->updateFooterWidgets();

        $this->command->info('');
        $this->command->info('=== Update Complete ===');
    }

    /**
     * Update Page Builder content
     */
    private function updatePageBuilderContent()
    {
        $this->command->info('Step 1: Updating Page Builder Content...');

        $homePageId = get_static_option('home_page');
        if (!$homePageId) {
            $homePage = Page::where('slug', 'home')
                ->orWhere('slug', 'homepage')
                ->orWhere('slug', 'index')
                ->first();
            $homePageId = $homePage ? $homePage->id : null;
        }

        if (!$homePageId) {
            $this->command->warn('Cannot find homepage ID. Skipping Page Builder update.');
            return;
        }

        // Get all page builders for homepage
        $pageBuilders = PageBuilder::where(function($query) use ($homePageId) {
                $query->where('addon_page_id', $homePageId)
                      ->orWhere('addon_page_type', 'homepage')
                      ->orWhere('addon_page_type', 'dynamic_page');
            })
            ->get();

        $this->command->info("Found {$pageBuilders->count()} page builder addons.");

        $updated = 0;
        foreach ($pageBuilders as $pageBuilder) {
            try {
                $settings = @unserialize($pageBuilder->addon_settings);
                
                if ($settings && is_array($settings)) {
                    $originalSettings = serialize($settings);
                    $settings = $this->updateArrayValues($settings);
                    $newSettings = serialize($settings);
                    
                    if ($newSettings !== $originalSettings) {
                        $pageBuilder->addon_settings = $newSettings;
                        $pageBuilder->save();
                        $updated++;
                        $this->command->info("  ✓ Updated: {$pageBuilder->addon_name}");
                    }
                }
            } catch (\Exception $e) {
                $this->command->warn("  ✗ Error updating {$pageBuilder->addon_name}: " . $e->getMessage());
            }
        }

        $this->command->info("✓ Updated {$updated} page builder addons.");
        $this->command->info('');
    }

    /**
     * Update Footer Widgets
     */
    private function updateFooterWidgets()
    {
        $this->command->info('Step 2: Updating Footer Widgets...');

        // Update widgets in widgets table
        $widgets = Widgets::where('widget_location', 'footer_two')
            ->orWhere('widget_location', 'copyright')
            ->orWhere('widget_location', 'footer_one')
            ->get();

        $this->command->info("Found {$widgets->count()} footer widgets.");

        $updated = 0;
        foreach ($widgets as $widget) {
            try {
                $settings = @unserialize($widget->widget_content);
                
                if ($settings && is_array($settings)) {
                    $originalSettings = serialize($settings);
                    $settings = $this->updateArrayValues($settings);
                    $newSettings = serialize($settings);
                    
                    if ($newSettings !== $originalSettings) {
                        $widget->widget_content = $newSettings;
                        $widget->save();
                        $updated++;
                        $this->command->info("  ✓ Updated widget: {$widget->widget_name}");
                    }
                }
            } catch (\Exception $e) {
                $this->command->warn("  ✗ Error updating widget ID {$widget->id}: " . $e->getMessage());
            }
        }

        $this->command->info("✓ Updated {$updated} footer widgets.");
        $this->command->info('');
    }
}

