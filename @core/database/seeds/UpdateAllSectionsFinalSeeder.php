<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\PageBuilder;
use App\Page;
use App\Widgets;

class UpdateAllSectionsFinalSeeder extends Seeder
{
    /**
     * Content replacements - more comprehensive
     */
    private $replacements = [
        // Best Taskers
        'Best Taskers of the Month' => 'أفضل الفنيين لهذا الشهر',
        'Top Technicians' => 'أفضل الفنيين',
        
        // Become Seller/Technician
        'Join with us as a service provider and earn a good remuneration' => 'انضم إلي فريق عمل صيانة تك',
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
        
        // Blog
        'Read our daily Blogs' => 'اقرأ مدونتنا',
        'Latest Blog Posts' => 'أحدث المقالات',
        'Read More' => 'اقرأ المزيد',
        'Explore More' => 'استكشف المزيد',
        
        // Footer
        'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less.' => 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.',
        'Community' => 'المجتمع',
        'Become A Buyer' => 'كن عميل',
        'Privacy Policy' => 'سياسة الخصوصية',
        'Terms & Conditions' => 'الشروط والأحكام',
    ];

    /**
     * Deep search and replace in array
     */
    private function deepReplace($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    $originalValue = $value;
                    foreach ($this->replacements as $old => $new) {
                        if (stripos($value, $old) !== false) {
                            $value = str_ireplace($old, $new, $value);
                        }
                    }
                    if ($value !== $originalValue) {
                        $data[$key] = $value;
                    }
                } elseif (is_array($value)) {
                    $data[$key] = $this->deepReplace($value);
                }
            }
        } elseif (is_string($data)) {
            foreach ($this->replacements as $old => $new) {
                if (stripos($data, $old) !== false) {
                    $data = str_ireplace($old, $new, $data);
                }
            }
        }
        
        return $data;
    }

    public function run()
    {
        $this->command->info('=== Starting Final Content Update ===');
        $this->command->info('');

        // Update Page Builder
        $this->updatePageBuilders();
        
        // Update Footer Widgets
        $this->updateFooterWidgets();

        $this->command->info('');
        $this->command->info('=== Update Complete ===');
    }

    private function updatePageBuilders()
    {
        $this->command->info('Updating Page Builders...');
        
        $homePageId = get_static_option('home_page');
        if (!$homePageId) {
            $homePage = Page::where('slug', 'home')
                ->orWhere('slug', 'homepage')
                ->orWhere('slug', 'index')
                ->first();
            $homePageId = $homePage ? $homePage->id : null;
        }

        if (!$homePageId) {
            $this->command->warn('Homepage ID not found.');
            return;
        }

        $pageBuilders = PageBuilder::where(function($query) use ($homePageId) {
                $query->where('addon_page_id', $homePageId)
                      ->orWhere('addon_page_type', 'homepage')
                      ->orWhere('addon_page_type', 'dynamic_page');
            })
            ->get();

        $updated = 0;
        foreach ($pageBuilders as $pb) {
            try {
                $settings = @unserialize($pb->addon_settings);
                if ($settings && is_array($settings)) {
                    $original = serialize($settings);
                    $settings = $this->deepReplace($settings);
                    $new = serialize($settings);
                    
                    if ($new !== $original) {
                        $pb->addon_settings = $new;
                        $pb->save();
                        $updated++;
                        $this->command->info("  ✓ Updated: {$pb->addon_name}");
                    }
                }
            } catch (\Exception $e) {
                // Silent fail
            }
        }
        
        $this->command->info("✓ Updated {$updated} page builders.");
    }

    private function updateFooterWidgets()
    {
        $this->command->info('Updating Footer Widgets...');
        
        $widgets = Widgets::whereIn('widget_location', ['footer_one', 'footer_two', 'copyright'])
            ->get();

        $updated = 0;
        foreach ($widgets as $widget) {
            try {
                $settings = @unserialize($widget->widget_content);
                if ($settings && is_array($settings)) {
                    $original = serialize($settings);
                    $settings = $this->deepReplace($settings);
                    $new = serialize($settings);
                    
                    if ($new !== $original) {
                        $widget->widget_content = $new;
                        $widget->save();
                        $updated++;
                        $this->command->info("  ✓ Updated: {$widget->widget_name}");
                    }
                }
            } catch (\Exception $e) {
                // Silent fail
            }
        }
        
        $this->command->info("✓ Updated {$updated} footer widgets.");
    }
}

