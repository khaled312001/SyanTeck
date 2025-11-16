<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\Order;
use App\Service;
use App\ServiceCity;
use App\ServiceArea;
use App\Country;
use App\Region;
use App\Category;
use App\Subcategory;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class MakkahDummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== بدء إنشاء البيانات الوهمية لمكة المكرمة ===');
        $this->command->info('');

        // الحصول على الأدوار
        $clientRole = Role::where('name', 'Client')->first();
        $technicianRole = Role::where('name', 'Technician')->first();
        $adminRole = Role::where('name', 'Admin')->first();

        // الحصول على السعودية ومكة
        $saudiArabia = Country::where('country', 'السعودية')
            ->orWhere('country', 'Saudi Arabia')
            ->orWhere('country', 'المملكة العربية السعودية')
            ->first();

        if (!$saudiArabia) {
            $saudiArabia = Country::create([
                'country' => 'السعودية',
                'status' => 1,
                'country_code' => 'SA',
            ]);
        }

        $makkahCity = ServiceCity::where('service_city', 'مكة المكرمة')
            ->orWhere('service_city', 'مكة')
            ->first();

        if (!$makkahCity) {
            $makkahCity = ServiceCity::create([
                'service_city' => 'مكة المكرمة',
                'country_id' => $saudiArabia->id,
                'status' => 1,
            ]);
        }

        // الحصول على المناطق
        $regions = Region::where('city_id', $makkahCity->id)->get();
        
        if ($regions->isEmpty()) {
            $this->command->warn('لا توجد مناطق في مكة. يرجى تشغيل UpdateMakkahRegionsSeeder أولاً.');
            return;
        }

        // إنشاء عملاء
        $this->command->info('--- إنشاء العملاء ---');
        $clients = $this->createClients($regions, $makkahCity, $saudiArabia, $clientRole);

        // إنشاء فنيين
        $this->command->info('--- إنشاء الفنيين ---');
        $technicians = $this->createTechnicians($regions, $makkahCity, $saudiArabia, $technicianRole);

        // إنشاء فئات وخدمات (بعد إنشاء الفنيين)
        $this->command->info('--- إنشاء الفئات والخدمات ---');
        $categories = $this->createCategories();
        $services = $this->createServices($categories, $makkahCity, $technicians);

        // إنشاء طلبات
        $this->command->info('--- إنشاء الطلبات ---');
        $this->createOrders($clients, $technicians, $services, $regions, $makkahCity, $saudiArabia);

        $this->command->info('');
        $this->command->info('=== تم إنشاء البيانات الوهمية بنجاح ===');
        $this->command->info("✓ العملاء: " . $clients->count());
        $this->command->info("✓ الفنيين: " . $technicians->count());
        $this->command->info("✓ الخدمات: " . $services->count());
        $this->command->info("✓ الطلبات: " . Order::whereIn('buyer_id', $clients->pluck('id'))->count());
    }

    private function createCategories()
    {
        $categories = [
            ['name' => 'صيانة تكييف', 'name_ar' => 'صيانة تكييف', 'icon' => 'ti-settings'],
            ['name' => 'صيانة كهرباء', 'name_ar' => 'صيانة كهرباء', 'icon' => 'ti-bolt'],
            ['name' => 'صيانة سباكة', 'name_ar' => 'صيانة سباكة', 'icon' => 'ti-drop'],
            ['name' => 'صيانة أجهزة منزلية', 'name_ar' => 'صيانة أجهزة منزلية', 'icon' => 'ti-home'],
            ['name' => 'صيانة أجهزة إلكترونية', 'name_ar' => 'صيانة أجهزة إلكترونية', 'icon' => 'ti-desktop'],
        ];

        $createdCategories = collect();

        foreach ($categories as $cat) {
            $category = Category::firstOrCreate(
                ['name' => $cat['name']],
                [
                    'name' => $cat['name'],
                    'status' => 1,
                    'icon' => $cat['icon'] ?? 'ti-settings',
                ]
            );
            $createdCategories->push($category);
        }

        return $createdCategories;
    }

    private function createServices($categories, $makkahCity, $technicians)
    {
        $services = [
            ['name' => 'صيانة مكيف سبليت', 'category' => 'صيانة تكييف', 'price' => 150],
            ['name' => 'صيانة مكيف شباك', 'category' => 'صيانة تكييف', 'price' => 120],
            ['name' => 'صيانة مكيف مركزي', 'category' => 'صيانة تكييف', 'price' => 300],
            ['name' => 'صيانة كهرباء منزلية', 'category' => 'صيانة كهرباء', 'price' => 100],
            ['name' => 'تركيب مفتاح كهربائي', 'category' => 'صيانة كهرباء', 'price' => 50],
            ['name' => 'صيانة سباكة عامة', 'category' => 'صيانة سباكة', 'price' => 80],
            ['name' => 'إصلاح تسرب مياه', 'category' => 'صيانة سباكة', 'price' => 120],
            ['name' => 'صيانة غسالة', 'category' => 'صيانة أجهزة منزلية', 'price' => 200],
            ['name' => 'صيانة ثلاجة', 'category' => 'صيانة أجهزة منزلية', 'price' => 250],
            ['name' => 'صيانة تلفزيون', 'category' => 'صيانة أجهزة إلكترونية', 'price' => 180],
        ];

        $createdServices = collect();

        foreach ($services as $serviceData) {
            $category = $categories->firstWhere('name', $serviceData['category']);
            if (!$category) continue;

            // استخدام فني عشوائي
            $technician = $technicians->random();

            $service = Service::create([
                'title' => $serviceData['name'],
                'slug' => Str::slug($serviceData['name'] . '-' . uniqid()),
                'description' => 'خدمة ' . $serviceData['name'] . ' في مكة المكرمة. نقدم خدمة صيانة احترافية وسريعة.',
                'category_id' => $category->id,
                'price' => $serviceData['price'],
                'seller_id' => $technician->id, // استخدام فني
                'status' => 1,
                'is_service_on' => 1,
                'service_city_id' => $makkahCity->id,
                'is_service_all_cities' => 0,
            ]);

            $createdServices->push($service);
        }

        return $createdServices;
    }

    private function createClients($regions, $makkahCity, $saudiArabia, $clientRole)
    {
        $arabicNames = [
            'محمد أحمد العتيبي', 'فهد سعد القحطاني', 'عبدالله خالد الحربي',
            'سعد محمد الزهراني', 'خالد فهد الدوسري', 'عمر عبدالرحمن الشهري',
            'يوسف إبراهيم المطيري', 'أحمد صالح الغامدي', 'علي حسن الجهني',
            'حسام عبدالله الثقفي', 'ماجد ناصر العسيري', 'بندر طلال البقمي',
            'سلطان فيصل القرني', 'نايف راشد السبيعي', 'تركي مشعل العنزي',
            'وليد هشام الرشيد', 'بدر خليفة المالكي', 'فيصل عبدالعزيز الشمري',
            'عبدالرحمن سليمان العلي', 'مشعل نايف الحارثي', 'راشد فهد البقمي',
            'عبدالعزيز محمد العتيبي', 'منصور خالد القحطاني', 'مشاري سعد الحربي',
            'عبدالمحسن فهد الزهراني', 'سلمان عبدالله الدوسري', 'مشعل عمر الشهري',
            'عبداللطيف يوسف المطيري', 'عبدالمجيد أحمد الغامدي', 'عبدالهادي علي الجهني',
        ];

        $clients = collect();

        foreach ($arabicNames as $index => $name) {
            $region = $regions->random();
            
            $client = User::create([
                'name' => $name,
                'username' => 'client_' . Str::slug($name) . '_' . $index . '_' . time() . '_' . uniqid(),
                'email' => 'client' . ($index + 1) . '_' . time() . '@makkah.com',
                'phone' => '05' . rand(10000000, 99999999),
                'password' => Hash::make('password'),
                'user_type' => 0, // Buyer/Client
                'user_status' => 1,
                'country_id' => $saudiArabia->id,
                'service_city' => $makkahCity->id,
                'address' => 'منطقة ' . $region->name_ar . '، مكة المكرمة',
                'post_code' => rand(20000, 29999),
            ]);

            if ($clientRole) {
                $client->assignRole($clientRole);
            }

            $clients->push($client);
        }

        return $clients;
    }

    private function createTechnicians($regions, $makkahCity, $saudiArabia, $technicianRole)
    {
        $technicianNames = [
            'فني محمد العتيبي', 'فني فهد القحطاني', 'فني عبدالله الحربي',
            'فني سعد الزهراني', 'فني خالد الدوسري', 'فني عمر الشهري',
        ];

        $technicians = collect();

        foreach ($technicianNames as $index => $name) {
            $assignedRegions = $regions->random(rand(3, 6))->pluck('id')->toArray();
            
            $technician = User::create([
                'name' => $name,
                'username' => 'tech_' . Str::slug($name) . '_' . $index . '_' . time() . '_' . uniqid(),
                'email' => 'tech' . ($index + 1) . '_' . time() . '@makkah.com',
                'phone' => '05' . rand(10000000, 99999999),
                'password' => Hash::make('password'),
                'user_type' => 1, // Seller/Technician
                'user_status' => 1,
                'country_id' => $saudiArabia->id,
                'service_city' => $makkahCity->id,
                'address' => 'مكة المكرمة',
                'is_available' => rand(0, 1),
                'rating' => rand(40, 50) / 10,
                'completed_orders_count' => rand(10, 100),
                'assigned_regions' => json_encode($assignedRegions),
            ]);

            if ($technicianRole) {
                $technician->assignRole($technicianRole);
            }

            // ربط الفني بالمناطق
            $technician->regions()->sync($assignedRegions);

            $technicians->push($technician);
        }

        return $technicians;
    }

    private function createOrders($clients, $technicians, $services, $regions, $makkahCity, $saudiArabia)
    {
        $statuses = [0, 1, 2, 3]; // pending, active, completed, delivered
        $urgencyLevels = ['normal', 'urgent', 'emergency'];
        $paymentStatuses = ['pending', 'complete'];
        $paymentGateways = ['cash', 'bank_transfer', 'wallet'];

        $issueDescriptions = [
            'مكيف لا يعمل', 'تسرب مياه', 'مفتاح كهربائي معطل',
            'غسالة لا تعمل', 'ثلاجة لا تبرد', 'تلفزيون لا يعمل',
            'مكيف يخرج هواء ساخن', 'تسرب في الحمام', 'انقطاع كهرباء',
            'مكيف يصدر صوت عالي', 'مياه ساخنة لا تعمل', 'مصباح لا يعمل',
        ];

        for ($i = 0; $i < 50; $i++) {
            $client = $clients->random();
            $service = $services->random();
            $region = $regions->random();
            // تأكد من وجود فني دائماً
            $technician = $technicians->random();
            
            $status = $statuses[array_rand($statuses)];
            $packageFee = $service->price;
            $extraService = rand(0, 200);
            $subTotal = $packageFee + $extraService;
            $tax = $subTotal * 0.15; // 15% VAT
            $total = $subTotal + $tax;

            $orderDate = Carbon::now()->subDays(rand(0, 30));
            $assignedAt = $orderDate->copy()->addHours(rand(1, 5));
            $acceptedAt = ($status >= 1) ? $assignedAt->copy()->addHours(rand(1, 3)) : null;
            $completedAt = ($status >= 2) ? $orderDate->copy()->addDays(rand(1, 3)) : null;

            $order = Order::create([
                'invoice' => 'INV-' . strtoupper(Str::random(8)),
                'service_id' => $service->id,
                'seller_id' => $technician->id,
                'buyer_id' => $client->id,
                'name' => $client->name,
                'email' => $client->email,
                'phone' => $client->phone,
                'post_code' => $client->post_code,
                'address' => $client->address,
                'city' => $makkahCity->id,
                'area' => null,
                'country' => $saudiArabia->id,
                'region_id' => $region->id,
                'date' => $orderDate->format('Y-m-d'),
                'schedule' => rand(8, 20) . ':00',
                'package_fee' => $packageFee,
                'extra_service' => $extraService,
                'sub_total' => $subTotal,
                'tax' => $tax,
                'total' => $total,
                'payment_gateway' => $paymentGateways[array_rand($paymentGateways)],
                'payment_status' => $status >= 2 ? 'complete' : $paymentStatuses[array_rand($paymentStatuses)],
                'status' => $status,
                'urgency_level' => $urgencyLevels[array_rand($urgencyLevels)],
                'order_note' => $issueDescriptions[array_rand($issueDescriptions)],
                'notes' => 'ملاحظات إضافية حول الطلب',
                'tracking_code' => 'TRK-' . strtoupper(Str::random(10)),
                'warranty_code' => $status >= 2 ? 'WAR-' . strtoupper(Str::random(10)) : null,
                'warranty_days' => $status >= 2 ? rand(30, 365) : 30, // قيمة افتراضية
                'has_warranty' => $status >= 2,
                'assigned_by' => 1, // Admin ID (افتراضي)
                'assigned_at' => $assignedAt,
                'accepted_at' => $acceptedAt,
                'completed_at' => $completedAt,
                'is_order_online' => 0,
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            // إنشاء رقم فاتورة إذا كان الطلب مكتمل
            if ($status >= 2) {
                $order->invoice_number = 'INV-' . date('Y') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
                $order->invoice_date = $completedAt ? $completedAt->format('Y-m-d') : Carbon::now()->format('Y-m-d');
                $order->save();
            }
        }
    }
}

