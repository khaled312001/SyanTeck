<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\PageBuilder;
use App\Page;

class UpdatePageBuilderContentSeeder extends Seeder
{
    /**
     * Translations mapping
     */
    private $translations = [
        'Get any tasks done by professionals' => 'احصل على <span style="color: #FFD700; font-weight: 700;">صيانتك</span> عن طريق فنيين موثوقين',
        'Order service you need. We have professionals ready to help.' => 'اطلب الخدمة التي تحتاجها. لدينا محترفون جاهزون للمساعدة.',
        'Find Service' => 'ابحث عن خدمة',
        'Post Job' => 'طلب خدمة',
        'Good service, good price' => 'خدمة جيدة، سعر جيد',
        'Set Location' => 'تحديد الموقع',
        '3k+ Satisfied Customer' => 'أكثر من 3000 عميل راضٍ',
        'Why Choose Qixer' => 'لماذا منصة الصيانة',
        'Why Our Marketplace' => 'لماذا منصة الصيانة',
        'Start As Seller' => 'كن فني',
        'Join As A Seller' => 'انضم كفني',
        'Become A Seller' => 'كن فني',
        'Join with us as a service provider and earn a good remuneration' => 'انضم إلي فريق عمل صيانة تك',
        'Get regular works' => 'احصل على أعمال منتظمة',
        'Generous service buyers' => 'عملاء كرماء',
        'Best Taskers of the Month' => 'أفضل الفنيين لهذا الشهر',
        'Get Our Mobile App to Order More Conveniently' => 'احصل على تطبيقنا المحمول للطلب بسهولة أكبر',
        'Pre-approved tasks' => 'مهام معتمدة مسبقاً',
        'Professionals available for services' => 'محترفون متاحون للخدمات',
        'Thriving to serve our customers the best. Hear our stories as told by customers.' => 'نسعى جاهدين لخدمة عملائنا بأفضل طريقة. استمع إلى قصصنا كما رواها العملاء.',
        'Read our daily Blogs' => 'اقرأ مدونتنا اليومية',
        'Categories' => 'الفئات',
        'Explore More' => 'استكشف المزيد',
        'Featured Services' => 'الخدمات المميزة',
        'Popular Services' => 'الخدمات الأكثر طلباً',
        'Book Now' => 'احجز الآن',
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
        $this->command->info('Starting Page Builder content update...');

        // Get homepage ID
        $homePage = Page::where('slug', 'home')->orWhere('slug', 'homepage')->first();
        if (!$homePage) {
            $homePageId = get_static_option('home_page');
            if ($homePageId) {
                $homePage = Page::find($homePageId);
            }
        }

        if (!$homePage) {
            $this->command->error('Homepage not found! Please set homepage in settings.');
            return;
        }

        $this->command->info("Found homepage with ID: {$homePage->id}");

        // Get all page builders for homepage
        $pageBuilders = PageBuilder::where('addon_page_id', $homePage->id)
            ->orWhere('addon_page_type', 'homepage')
            ->orWhere('addon_page_type', 'dynamic_page')
            ->get();

        $this->command->info("Found {$pageBuilders->count()} page builder addons to update.");

        $updated = 0;
        foreach ($pageBuilders as $pageBuilder) {
            try {
                $settings = unserialize($pageBuilder->addon_settings);
                
                if ($settings && is_array($settings)) {
                    $originalSettings = $settings;
                    $settings = $this->updateArrayValues($settings);
                    
                    // Check if anything changed
                    if ($settings !== $originalSettings) {
                        $pageBuilder->addon_settings = serialize($settings);
                        $pageBuilder->save();
                        $updated++;
                        $this->command->info("Updated: {$pageBuilder->addon_name}");
                    }
                }
            } catch (\Exception $e) {
                $this->command->warn("Error updating {$pageBuilder->addon_name}: " . $e->getMessage());
            }
        }

        // Also update About and Contact pages
        $this->updatePageTitle('about', 'من نحن');
        $this->updatePageTitle('contact', 'تواصل معنا');

        $this->command->info("Update complete! Updated {$updated} addons.");
        $this->command->info('');
        $this->command->info('Note: Some content may need manual update from admin panel.');
        $this->command->info('Go to: /admin/page-builder/home-page to review and update remaining content.');
    }

    /**
     * Update page title
     */
    private function updatePageTitle($slug, $title)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page) {
            $page->title = $title;
            $page->save();
            $this->command->info("Updated page title: {$slug} → {$title}");
        }
    }
}
