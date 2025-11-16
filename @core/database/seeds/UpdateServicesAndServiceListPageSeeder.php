<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\Category;
use App\Page;
use App\PageBuilder;
use App\User;
use App\ServiceCity;
use Illuminate\Support\Str;

class UpdateServicesAndServiceListPageSeeder extends Seeder
{
    /**
     * Maintenance services data
     */
    private $maintenanceServices = [
        [
            'category' => 'كهرباء',
            'title' => 'صيانة وإصلاح الأعطال الكهربائية',
            'description' => '<p>نوفر خدمات صيانة وإصلاح شاملة للأعطال الكهربائية في المنازل والمكاتب. فريقنا من الفنيين المعتمدين جاهز لمعالجة جميع المشاكل الكهربائية بسرعة وأمان.</p><p><br></p><p>تشمل خدماتنا:</p><ul><li>إصلاح الدوائر الكهربائية</li><li>استبدال الأسلاك والكابلات</li><li>تركيب وصيانة لوحات التوزيع</li><li>إصلاح المفاتيح والمقابس</li><li>صيانة أنظمة الإضاءة</li></ul>',
            'price' => 150,
        ],
        [
            'category' => 'كهرباء',
            'title' => 'تركيب وصيانة الدوائر الكهربائية',
            'description' => '<p>خدمات احترافية لتركيب وصيانة الدوائر الكهربائية الجديدة. نضمن أعلى معايير السلامة والجودة في جميع أعمالنا.</p><p><br></p><p>خدماتنا تشمل:</p><ul><li>تركيب دوائر كهربائية جديدة</li><li>صيانة الدوائر الموجودة</li><li>تحديث الأنظمة القديمة</li><li>فحص شامل للأنظمة</li></ul>',
            'price' => 200,
        ],
        [
            'category' => 'سباكة',
            'title' => 'إصلاح تسريبات المياه',
            'description' => '<p>حلول سريعة وفعالة لمشاكل تسريبات المياه. فريقنا المتخصص يتعامل مع جميع أنواع التسريبات بسرعة واحترافية.</p><p><br></p><p>نقدم:</p><ul><li>كشف التسريبات</li><li>إصلاح الأنابيب المتسربة</li><li>استبدال القطع التالفة</li><li>صيانة دورية</li></ul>',
            'price' => 120,
        ],
        [
            'category' => 'سباكة',
            'title' => 'تركيب وصيانة الأنابيب',
            'description' => '<p>خدمات تركيب وصيانة الأنابيب للمنازل والمباني. نستخدم أفضل المواد وأحدث التقنيات لضمان جودة العمل.</p><p><br></p><p>خدماتنا:</p><ul><li>تركيب أنابيب جديدة</li><li>صيانة الأنابيب القديمة</li><li>استبدال الأنابيب التالفة</li><li>تركيب الأدوات الصحية</li></ul>',
            'price' => 180,
        ],
        [
            'category' => 'تكييف',
            'title' => 'صيانة وتركيب أجهزة التكييف',
            'description' => '<p>خدمات شاملة لصيانة وتركيب جميع أنواع أجهزة التكييف. نحافظ على برودة منزلك في جميع الأوقات.</p><p><br></p><p>نقدم:</p><ul><li>تركيب أجهزة تكييف جديدة</li><li>صيانة دورية للأجهزة</li><li>تنظيف الفلاتر</li><li>إصلاح الأعطال</li><li>شحن الغاز</li></ul>',
            'price' => 250,
        ],
        [
            'category' => 'تكييف',
            'title' => 'تنظيف وصيانة وحدات التكييف',
            'description' => '<p>خدمات تنظيف وصيانة احترافية لوحدات التكييف لضمان كفاءة عالية وجودة هواء أفضل.</p><p><br></p><p>تشمل:</p><ul><li>تنظيف شامل للوحدات</li><li>صيانة المكونات</li><li>استبدال الفلاتر</li><li>فحص شامل</li></ul>',
            'price' => 100,
        ],
        [
            'category' => 'أجهزة منزلية',
            'title' => 'صيانة الأجهزة المنزلية',
            'description' => '<p>خدمات صيانة شاملة لجميع الأجهزة المنزلية. فريقنا المتخصص يصلح جميع أنواع الأجهزة بسرعة وكفاءة.</p><p><br></p><p>نصلح:</p><ul><li>الغسالات والمناشف</li><li>الثلاجات والمجمدات</li><li>الأفران والمواقد</li><li>أجهزة المطبخ</li></ul>',
            'price' => 150,
        ],
        [
            'category' => 'أجهزة منزلية',
            'title' => 'إصلاح الأجهزة الكهربائية',
            'description' => '<p>خدمات إصلاح احترافية للأجهزة الكهربائية المنزلية. نوفر قطع الغيار الأصلية وضمان على العمل.</p><p><br></p><p>خدماتنا:</p><ul><li>إصلاح جميع أنواع الأجهزة</li><li>استبدال القطع التالفة</li><li>صيانة دورية</li><li>ضمان على العمل</li></ul>',
            'price' => 130,
        ],
        [
            'category' => 'نجارة',
            'title' => 'أعمال النجارة والديكور',
            'description' => '<p>خدمات نجارة وديكور احترافية لتحسين مظهر منزلك. نقدم حلولاً مبتكرة وعملية لجميع احتياجاتك.</p><p><br></p><p>نقدم:</p><ul><li>تصميم وتنفيذ الديكورات</li><li>أعمال النجارة الخشبية</li><li>تركيب الأرفف والخزائن</li><li>أعمال الترميم</li></ul>',
            'price' => 300,
        ],
        [
            'category' => 'نجارة',
            'title' => 'إصلاح الأثاث',
            'description' => '<p>خدمات إصلاح الأثاث بجميع أنواعه. نحافظ على أثاثك ونعيده لحالته الأصلية.</p><p><br></p><p>نصلح:</p><ul><li>الأثاث الخشبي</li><li>الأثاث المنجد</li><li>الأبواب والنوافذ</li><li>الأرفف والخزائن</li></ul>',
            'price' => 200,
        ],
        [
            'category' => 'دهان',
            'title' => 'دهانات داخلية وخارجية',
            'description' => '<p>خدمات دهان احترافية للمنازل والمباني. نستخدم أفضل أنواع الدهانات لضمان مظهر جميل ودائم.</p><p><br></p><p>خدماتنا:</p><ul><li>دهان الجدران الداخلية</li><li>دهان الواجهات الخارجية</li><li>دهان الأبواب والنوافذ</li><li>أعمال الديكور</li></ul>',
            'price' => 180,
        ],
        [
            'category' => 'دهان',
            'title' => 'أعمال الدهان والديكور',
            'description' => '<p>خدمات دهان وديكور متكاملة لتحويل منزلك إلى تحفة فنية. نقدم حلولاً مبتكرة وأنيقة.</p><p><br></p><p>نقدم:</p><ul><li>تصميم ديكورات مبتكرة</li><li>دهان بألوان عصرية</li><li>أعمال الديكور الجبسية</li><li>تنسيق الألوان</li></ul>',
            'price' => 250,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Starting services and service-list page update...');

        // Delete all existing services (using delete instead of truncate due to foreign keys)
        $deletedCount = Service::count();
        
        // Disable foreign key checks temporarily (MySQL only)
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        
        Service::query()->delete();
        
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
        
        $this->command->info("Deleted {$deletedCount} existing services.");

        // Get or create categories
        $categories = [];
        foreach (['كهرباء', 'سباكة', 'تكييف', 'أجهزة منزلية', 'نجارة', 'دهان'] as $catName) {
            $category = Category::firstOrCreate(
                ['name' => $catName],
                [
                    'slug' => Str::slug($catName),
                    'status' => 1,
                    'icon' => 'las la-tools',
                ]
            );
            $categories[$catName] = $category;
            $this->command->info("Category '{$catName}' ready (ID: {$category->id})");
        }

        // Get first admin user as seller_id (or create a default technician)
        $adminUser = User::where('user_type', 0)->first();
        if (!$adminUser) {
            $this->command->warn('No admin user found. Services will be created without seller_id.');
        }

        // Get first service city
        $serviceCity = ServiceCity::first();
        if (!$serviceCity) {
            $this->command->warn('No service city found. Services will be created without service_city_id.');
        }

        // Create new services
        $created = 0;
        foreach ($this->maintenanceServices as $index => $serviceData) {
            $category = $categories[$serviceData['category']];
            
            $service = Service::create([
                'category_id' => $category->id,
                'subcategory_id' => null,
                'child_category_id' => null,
                'seller_id' => $adminUser->id ?? 1,
                'service_city_id' => $serviceCity->id ?? 1,
                'service_area_id' => null,
                'title' => $serviceData['title'],
                'slug' => Str::slug($serviceData['title']),
                'description' => $serviceData['description'],
                'image' => null, // You can add images later
                'status' => 1,
                'is_service_on' => 1,
                'price' => $serviceData['price'],
                'tax' => 0,
                'view' => 0,
                'featured' => $index < 3 ? 1 : 0, // First 3 services are featured
                'image_gallery' => null,
                'video' => null,
                'is_service_all_cities' => 1,
            ]);

            $created++;
            $this->command->info("Created service: {$serviceData['title']}");
        }

        // Update service-list page
        $serviceListPage = Page::where('slug', 'service-list')->first();
        if ($serviceListPage) {
            $serviceListPage->title = 'الخدمات';
            $serviceListPage->save();
            $this->command->info("Updated service-list page title to: الخدمات");
        }

        // Delete unnecessary addons from service-list page
        if ($serviceListPage) {
            $pageBuilders = PageBuilder::where('addon_page_id', $serviceListPage->id)->get();
            $deletedAddons = 0;
            foreach ($pageBuilders as $pageBuilder) {
                // Keep only ServiceListOne or similar service listing addons
                if (!in_array($pageBuilder->addon_name, ['ServiceListOne', 'OnlineServiceList'])) {
                    $pageBuilder->delete();
                    $deletedAddons++;
                    $this->command->info("Deleted unnecessary addon from service-list: {$pageBuilder->addon_name}");
                }
            }
            $this->command->info("Deleted {$deletedAddons} unnecessary addons from service-list page.");
        }

        $this->command->info('');
        $this->command->info("Update complete!");
        $this->command->info("- Deleted: {$deletedCount} old services");
        $this->command->info("- Created: {$created} new maintenance services");
        $this->command->info('');
        $this->command->info('Services are now ready! Visit: http://localhost/SyanTeck/service-list');
    }
}

