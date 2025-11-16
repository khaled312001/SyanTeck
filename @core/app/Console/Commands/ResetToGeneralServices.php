<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Service;
use App\User;
use App\Category;
use Illuminate\Support\Str;

class ResetToGeneralServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'services:reset-to-general';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all existing services and create general maintenance services only';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('جاري حذف جميع الخدمات الموجودة...');
        
        // حذف جميع الخدمات والبيانات المرتبطة
        $totalServices = Service::count();
        $deleted = 0;
        
        // حذف الخدمات واحدة تلو الأخرى لضمان حذف البيانات المرتبطة
        Service::chunk(100, function ($services) use (&$deleted) {
            foreach ($services as $service) {
                try {
                    // حذف البيانات المرتبطة أولاً
                    $service->serviceInclude()->delete();
                    $service->serviceAdditional()->delete();
                    $service->serviceBenifit()->delete();
                    $service->serviceFaq()->delete();
                    
                    // حذف الخدمة
                    $service->delete();
                    $deleted++;
                } catch (\Exception $e) {
                    $this->error("خطأ في حذف الخدمة ID: {$service->id} - {$e->getMessage()}");
                }
            }
        });
        
        $this->info("تم حذف {$deleted} من أصل {$totalServices} خدمة.");
        
        // الحصول على أول فئة متاحة
        $category = Category::where('status', 1)->first();
        
        if (!$category) {
            $this->error('لا توجد فئات متاحة. يرجى إنشاء فئة أولاً.');
            return Command::FAILURE;
        }
        
        // الحصول على أول مستخدم (admin أو seller)
        $seller = User::where('user_type', 0)->first();
        
        if (!$seller) {
            $this->error('لا يوجد فني متاح. يرجى إنشاء فني أولاً.');
            return Command::FAILURE;
        }
        
        // قائمة الخدمات العامة
        $generalServices = [
            [
                'title' => 'صيانة عامة',
                'description' => 'خدمة صيانة شاملة لجميع أنواع الأعطال والإصلاحات المنزلية والتقنية',
            ],
            [
                'title' => 'صيانة كهربائية',
                'description' => 'إصلاح وصيانة جميع الأعطال الكهربائية والدوائر الكهربائية',
            ],
            [
                'title' => 'صيانة سباكة',
                'description' => 'إصلاح وصيانة جميع أعطال السباكة والأنابيب والمياه',
            ],
            [
                'title' => 'صيانة تكييف',
                'description' => 'صيانة وإصلاح جميع أنواع أجهزة التكييف والتبريد',
            ],
            [
                'title' => 'صيانة أجهزة منزلية',
                'description' => 'صيانة وإصلاح جميع الأجهزة المنزلية والإلكترونية',
            ],
            [
                'title' => 'صيانة بناء وترميم',
                'description' => 'خدمات البناء والترميم والصيانة الإنشائية',
            ],
            [
                'title' => 'صيانة دهان وديكور',
                'description' => 'خدمات الدهان والديكور والتشطيبات',
            ],
            [
                'title' => 'صيانة نجارة',
                'description' => 'خدمات النجارة والأعمال الخشبية',
            ],
        ];
        
        $this->info('جاري إنشاء الخدمات العامة...');
        
        $created = 0;
        foreach ($generalServices as $serviceData) {
            try {
                Service::create([
                    'category_id' => $category->id,
                    'subcategory_id' => null,
                    'child_category_id' => null,
                    'seller_id' => $seller->id,
                    'service_city_id' => 1, // يمكن تعديله حسب الحاجة
                    'service_area_id' => null,
                    'title' => $serviceData['title'],
                    'slug' => Str::slug($serviceData['title']),
                    'description' => '<p>' . $serviceData['description'] . '</p>',
                    'image' => null,
                    'image_gallery' => null,
                    'video' => null,
                    'status' => 1,
                    'is_service_on' => 1,
                    'price' => 0,
                    'online_service_price' => 0,
                    'delivery_days' => 0,
                    'revision' => 0,
                    'is_service_online' => 0,
                    'is_service_all_cities' => 1,
                    'tax' => 0,
                    'view' => 0,
                    'sold_count' => 0,
                    'featured' => 0,
                ]);
                $created++;
                $this->line("✓ تم إنشاء: {$serviceData['title']}");
            } catch (\Exception $e) {
                $this->error("✗ خطأ في إنشاء: {$serviceData['title']} - {$e->getMessage()}");
            }
        }
        
        $this->info("تم إنشاء {$created} خدمة عامة بنجاح!");
        $this->info('الخدمات العامة الجديدة جاهزة للاستخدام.');
        
        return Command::SUCCESS;
    }
}

