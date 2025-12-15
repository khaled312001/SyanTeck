<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\PageBuilder;
use App\Page;
use App\StaticOption;
use App\Category;

class UpdateHomepageContentSeeder extends Seeder
{
    /**
     * Content mapping based on the summary provided
     */
    private $contentMapping = [
        // Hero Banner
        'Get any tasks done by professionals' => 'احصل على <span style="color: #FFD700; font-weight: 900;">صيانتك</span> عن طريق فنيين موثوقين',
        'Get any service from' => 'احصل على <span style="color: #FFD700; font-weight: 900;">صيانتك</span> عن طريق فنيين موثوقين',
        'احصل على أي خدمة من' => 'احصل على <span style="color: #FFD700; font-weight: 900;">صيانتك</span> عن طريق فنيين موثوقين',
        'احصل على أي خدمة' => 'احصل على <span style="color: #FFD700; font-weight: 900;">صيانتك</span> عن طريق فنيين موثوقين',
        'Order service you need. We have professionals ready to help.' => '', // Empty to hide subtitle
        'اطلب الخدمة التي تحتاجها. لدينا فنيون معتمدون جاهزون لخدمتك' => '', // Empty to hide subtitle
        'لدينا فنيون معتمدون جاهزون لخدمتك' => '', // Empty to hide subtitle
        'Find Service' => 'ابحث عن خدمة',
        'Post Job' => 'طلب خدمة',
        'Good service, good price' => 'خدمة جيدة، سعر جيد',
        'Set Location' => 'تحديد الموقع',
        '3k+ Satisfied Customer' => 'أكثر من 3000 عميل راضٍ',
        '2k+ Satisfied Customer' => 'أكثر من 3000 عميل راضٍ',
        
        // Why Choose Section
        'Why Choose Qixer' => 'لماذا صيانة تك؟',
        'Why Our Marketplace' => 'لماذا صيانة تك؟',
        'Why Choose Us' => 'لماذا صيانة تك؟',
        'Qixer is a best service-based marketplace out there to help you get any task done conveniently. Thanks to our well built mobile app and website for making it even convenient for the users.' => 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.',
        
        // Services
        'Popular Services' => 'الخدمات الأكثر طلباً',
        'Popular Service' => 'الخدمات الأكثر طلباً',
        'الخدمات الشائعة' => 'الخدمات الأكثر طلباً',
        'الخدمات الأكثر' => 'الخدمات الأكثر طلباً',
        'الخدمات المتاحة' => 'الخدمات الأكثر طلباً',
        'Featured Services' => 'الخدمات المميزة',
        'Book Now' => 'احجز الآن',
        'Explore More' => 'استكشف المزيد',
        'View All Services' => 'عرض جميع الخدمات',
        
        // Seller/Technician Section
        'Start As Seller' => 'كن فني',
        'Join As A Seller' => 'انضم كفني',
        'Become A Seller' => 'كن فني',
        'Join with us as a service provider and earn a good remuneration' => 'انضم إلينا كفني معتمد واكسب راتباً جيداً مع أعمال منتظمة',
        'Get regular works' => 'احصل على أعمال منتظمة',
        'Generous service buyers' => 'عملاء كرماء',
        
        // Categories
        'Categories' => 'فئات الخدمات',
        'All Categories' => 'جميع الفئات',
        'Browse Categories' => 'تصفح الفئات',
        
        // Old Category Names (to be replaced)
        'Electronics' => 'كهرباء',
        'Cleaning' => 'سباكة',
        'Home Move' => 'تكييف',
        'Salon & Spa' => 'أجهزة منزلية',
        'Helping' => 'نجارة',
        'Painting' => 'دهان',
        
        // Service Count
        '0+ Service' => 'خدمات متاحة',
        '0+ الخدمة' => 'خدمات متاحة',
        'noImage' => '',
        'no-image' => '',
        
        // Statistics
        'Best Taskers of the Month' => 'أفضل الفنيين لهذا الشهر',
        'Top Technicians' => 'أفضل الفنيين',
        
        // Mobile App
        'Get Our Mobile App to Order More Conveniently' => 'احصل على تطبيقنا المحمول للطلب بسهولة أكبر',
        'Pre-approved tasks' => 'مهام معتمدة مسبقاً',
        'Professionals available for services' => 'فنيون متاحون للخدمات',
        
        // Customer Stories
        'Thriving to serve our customers the best. Hear our stories as told by customers.' => 'نسعى جاهدين لخدمة عملائنا بأفضل طريقة. استمع إلى قصصنا كما رواها العملاء.',
        'Customer Stories' => 'قصص العملاء',
        'What Our Customers Say' => 'ماذا يقول عملاؤنا',
        
        // Blog
        'Read our daily Blogs' => 'اقرأ مدونتنا',
        'Latest Blog Posts' => 'أحدث المقالات',
        'Read More' => 'اقرأ المزيد',
        
        // Features
        '24/7 Support' => 'دعم 24/7',
        'Trained Professionals' => 'فنيون معتمدون',
        'Quality Service' => 'خدمة عالية الجودة',
        'Affordable Price' => 'أسعار مناسبة',
        'Digital Warranty' => 'ضمان رقمي',
        'Electronic Invoice' => 'فاتورة إلكترونية',
        'Real-time Tracking' => 'تتبع مباشر',
        'Transparent Pricing' => 'أسعار شفافة',
        'Secure' => 'آمن',
        'Support' => 'دعم',
        
        // Customer Reviews/Testimonials
        'People loved services provided by our taskers' => 'أحب الناس الخدمات المقدمة من قبل فنيينا',
        'We have dedicated support team to help you' => 'لدينا فريق دعم مخصص لمساعدتك على مدار الساعة',
        'Professional taskers' => 'فنيون محترفون',
        'Refund available if not satisfied' => 'استرداد متاح في حالة عدم الرضا',
        
        // Footer
        'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less.' => 'صيانة تك هي منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. توفر المنصة حلولاً شاملة لربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.',
        'Community' => 'المجتمع',
        'Become A Buyer' => 'كن عميل',
        'Privacy Policy' => 'سياسة الخصوصية',
        'Terms & Conditions' => 'الشروط والأحكام',
    ];

    /**
     * Statistics content based on summary
     */
    private $statisticsContent = [
        'cities_coverage' => 'تغطية المدن',
        'certified_technicians' => 'فنيون معتمدون',
        'service_24_7' => 'خدمة 24/7',
    ];

    /**
     * Recursively update array values
     */
    private function updateArrayValues($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    // Check if value matches any content mapping (exact match)
                    if (isset($this->contentMapping[$value])) {
                        $data[$key] = $this->contentMapping[$value];
                    } else {
                        // Check for partial matches in longer strings
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
                // Check for partial matches
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
        $this->command->info('=== Starting Homepage Content Update ===');
        $this->command->info('');

        // Step 1: Update Homepage Page
        $this->updateHomepagePage();

        // Step 2: Update Page Builder Content
        $this->updatePageBuilderContent();

        // Step 3: Update Static Options
        $this->updateStaticOptions();

        // Step 4: Update Categories
        $this->updateCategories();

        $this->command->info('');
        $this->command->info('=== Update Complete ===');
        $this->command->info('');
        $this->command->info('Note: Review the homepage at /admin/page-builder/home-page');
        $this->command->info('Some content may need manual adjustment from admin panel.');
    }

    /**
     * Update homepage page in pages table
     */
    private function updateHomepagePage()
    {
        $this->command->info('Step 1: Updating Homepage Page...');

        $homePageId = get_static_option('home_page');
        if (!$homePageId) {
            $this->command->warn('Homepage ID not found in static options. Trying to find by slug...');
            $homePage = Page::where('slug', 'home')
                ->orWhere('slug', 'homepage')
                ->orWhere('slug', 'index')
                ->first();
        } else {
            $homePage = Page::find($homePageId);
        }

        if (!$homePage) {
            $this->command->error('Homepage not found! Please set homepage in settings.');
            return;
        }

        $this->command->info("Found homepage: ID {$homePage->id}, Title: {$homePage->title}");

        // Update page title if needed
        if (empty($homePage->title) || $homePage->title === 'Home' || $homePage->title === 'Homepage') {
            $homePage->title = 'صيانة تك - منصة خدمات الصيانة المنزلية والتقنية';
            $homePage->save();
            $this->command->info('Updated homepage title.');
        }

        $this->command->info('✓ Homepage page updated');
        $this->command->info('');
    }

    /**
     * Update Page Builder content
     */
    private function updatePageBuilderContent()
    {
        $this->command->info('Step 2: Updating Page Builder Content...');

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
                    
                    // Special handling for PopularServiceThree and PopularService addons
                    if (in_array($pageBuilder->addon_name, ['PopularServiceThree', 'PopularService', 'PopularServiceTwo'])) {
                        // Update title field directly
                        if (isset($settings['title'])) {
                            $oldTitle = $settings['title'];
                            // Check if title needs updating
                            if (stripos($oldTitle, 'Popular Services') !== false || 
                                stripos($oldTitle, 'Popular Service') !== false ||
                                stripos($oldTitle, 'الخدمات الشائعة') !== false ||
                                stripos($oldTitle, 'الخدمات الأكثر') !== false ||
                                stripos($oldTitle, 'الخدمات المتاحة') !== false) {
                                $settings['title'] = 'الخدمات الأكثر طلباً';
                                $this->command->info("  → Title updated: '{$oldTitle}' → 'الخدمات الأكثر طلباً'");
                            }
                        }
                    }
                    
                    // Special handling for HeaderStyleOne addon
                    if ($pageBuilder->addon_name === 'HeaderStyleOne') {
                        // Update title field
                        if (isset($settings['title'])) {
                            $oldTitle = $settings['title'];
                            // Check if title needs updating
                            if (stripos($oldTitle, 'Get any service') !== false || 
                                stripos($oldTitle, 'Get any tasks') !== false ||
                                stripos($oldTitle, 'احصل على أي خدمة') !== false) {
                                $settings['title'] = 'احصل على <span style="color: #FFD700; font-weight: 900;">صيانتك</span> عن طريق فنيين موثوقين';
                                $this->command->info("  → Title updated: '{$oldTitle}' → 'احصل على صيانتك عن طريق فنيين موثوقين'");
                            }
                        }
                        // Remove subtitle (set to empty)
                        if (isset($settings['subtitle'])) {
                            $oldSubtitle = $settings['subtitle'];
                            if (!empty($oldSubtitle) && (
                                stripos($oldSubtitle, 'Order service you need') !== false ||
                                stripos($oldSubtitle, 'اطلب الخدمة التي تحتاجها') !== false ||
                                stripos($oldSubtitle, 'لدينا فنيون معتمدون') !== false
                            )) {
                                $settings['subtitle'] = '';
                                $this->command->info("  → Subtitle removed: '{$oldSubtitle}'");
                            }
                        }
                    }
                    
                    $settings = $this->updateArrayValues($settings);
                    $newSettings = serialize($settings);
                    
                    // Check if anything changed
                    if ($newSettings !== $originalSettings) {
                        $pageBuilder->addon_settings = $newSettings;
                        $pageBuilder->save();
                        $updated++;
                        $this->command->info("  ✓ Updated: {$pageBuilder->addon_name}");
                    } else {
                        // Try to find and update specific keys that might contain old content
                        $needsUpdate = false;
                        foreach ($settings as $key => $value) {
                            if (is_string($value)) {
                                foreach ($this->contentMapping as $oldText => $newText) {
                                    if (stripos($value, $oldText) !== false) {
                                        $settings[$key] = str_ireplace($oldText, $newText, $value);
                                        $needsUpdate = true;
                                    }
                                }
                            }
                        }
                        if ($needsUpdate) {
                            $pageBuilder->addon_settings = serialize($settings);
                            $pageBuilder->save();
                            $updated++;
                            $this->command->info("  ✓ Updated (deep search): {$pageBuilder->addon_name}");
                        }
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
     * Update static options
     */
    private function updateStaticOptions()
    {
        $this->command->info('Step 3: Updating Static Options...');

        $updates = [
            'site_ar_title' => 'صيانة تك - منصة خدمات الصيانة المنزلية والتقنية',
            'site_ar_tag_line' => 'منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية',
            'site_meta_ar_description' => 'صيانة تك - منصة إلكترونية متكاملة لإدارة خدمات الصيانة المنزلية والتقنية. ربط العملاء بالفنيين المعتمدين مع تتبع مباشر للطلبات، أسعار شفافة، فواتير إلكترونية، وضمانات رقمية.',
        ];

        $updated = 0;
        foreach ($updates as $optionName => $optionValue) {
            $staticOption = StaticOption::where('option_name', $optionName)->first();
            if ($staticOption) {
                $staticOption->option_value = $optionValue;
                $staticOption->save();
                $updated++;
                $this->command->info("  ✓ Updated: {$optionName}");
            } else {
                StaticOption::create([
                    'option_name' => $optionName,
                    'option_value' => $optionValue,
                ]);
                $updated++;
                $this->command->info("  ✓ Created: {$optionName}");
            }
        }

        $this->command->info("✓ Updated {$updated} static options.");
        $this->command->info('');
    }

    /**
     * Update categories in database
     */
    private function updateCategories()
    {
        $this->command->info('Step 4: Updating Categories...');

        $categoryUpdates = [
            'Electronics' => 'كهرباء',
            'Cleaning' => 'سباكة',
            'Home Move' => 'تكييف',
            'Salon & Spa' => 'أجهزة منزلية',
            'Helping' => 'نجارة',
            // Painting stays the same but ensure it's in Arabic
            'Painting' => 'دهان',
        ];

        $updated = 0;
        foreach ($categoryUpdates as $oldName => $newName) {
            $category = Category::where('name', $oldName)->first();
            if ($category) {
                $category->name = $newName;
                $category->save();
                $updated++;
                $this->command->info("  ✓ Updated category: {$oldName} → {$newName}");
            }
        }

        $this->command->info("✓ Updated {$updated} categories.");
        $this->command->info('');
    }
}

