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
use App\QualityFollowup;
use App\Review;
use App\SupportTicket;
use App\SupportTicketMessage;
use App\Admin;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
class CompleteDummyDataSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== بدء إنشاء البيانات الوهمية الشاملة ===');
        $this->command->info('');

        // إنشاء الأدوار إذا لم تكن موجودة
        $this->createRoles();

        // إنشاء الدول والمدن والمناطق
        $this->command->info('--- إنشاء الدول والمدن والمناطق ---');
        $saudiArabia = $this->createCountries();
        $cities = $this->createCities($saudiArabia);
        $regions = $this->createRegions($cities);

        // إنشاء الفئات والخدمات
        $this->command->info('--- إنشاء الفئات والخدمات ---');
        $categories = $this->createCategories();
        $subcategories = $this->createSubcategories($categories);
        $services = $this->createServices($categories, $subcategories, $cities, $saudiArabia);

        // إنشاء المستخدمين
        $this->command->info('--- إنشاء المستخدمين ---');
        $admins = $this->createAdmins();
        $supportAgents = $this->createSupportAgents($cities, $saudiArabia);
        $financeAgents = $this->createFinanceAgents($cities, $saudiArabia);
        $qualityAgents = $this->createQualityAgents($cities, $saudiArabia);
        $clients = $this->createClients($regions, $cities, $saudiArabia);
        $technicians = $this->createTechnicians($regions, $cities, $saudiArabia);

        // إنشاء الطلبات
        $this->command->info('--- إنشاء الطلبات ---');
        $orders = $this->createOrders($clients, $technicians, $services, $regions, $cities, $saudiArabia, $supportAgents);

        // إنشاء متابعات الجودة
        $this->command->info('--- إنشاء متابعات الجودة ---');
        $this->createQualityFollowups($orders, $qualityAgents);

        // إنشاء التقييمات
        $this->command->info('--- إنشاء التقييمات ---');
        $this->createReviews($orders, $clients);

        // إنشاء تذاكر الدعم
        $this->command->info('--- إنشاء تذاكر الدعم ---');
        $this->createSupportTickets($clients, $supportAgents);

        $this->command->info('');
        $this->command->info('=== تم إنشاء البيانات الوهمية بنجاح ===');
        $this->command->info("✓ الإداريين: " . $admins->count());
        $this->command->info("✓ وكلاء الدعم: " . $supportAgents->count());
        $this->command->info("✓ وكلاء المالية: " . $financeAgents->count());
        $this->command->info("✓ وكلاء الجودة: " . $qualityAgents->count());
        $this->command->info("✓ العملاء: " . $clients->count());
        $this->command->info("✓ الفنيين: " . $technicians->count());
        $this->command->info("✓ الفئات: " . $categories->count());
        $this->command->info("✓ الخدمات: " . $services->count());
        $this->command->info("✓ الطلبات: " . $orders->count());
        $this->command->info("✓ متابعات الجودة: " . QualityFollowup::count());
        $this->command->info("✓ التقييمات: " . Review::count());
        $this->command->info("✓ تذاكر الدعم: " . SupportTicket::count());
    }

    private function createRoles()
    {
        $roles = ['Admin', 'Support', 'Finance', 'Quality', 'Client', 'Technician'];
        
        foreach ($roles as $roleName) {
            Role::firstOrCreate(
                ['name' => $roleName, 'guard_name' => 'web'],
                ['name' => $roleName, 'guard_name' => 'web']
            );
        }
    }

    private function createCountries()
    {
        $saudiArabia = Country::firstOrCreate(
            ['country' => 'السعودية'],
            [
                'country' => 'السعودية',
                'status' => 1,
                'country_code' => 'SA',
                'flag' => '🇸🇦',
            ]
        );

        // إنشاء دول إضافية
        $countries = [
            ['country' => 'الإمارات العربية المتحدة', 'code' => 'AE', 'flag' => '🇦🇪'],
            ['country' => 'الكويت', 'code' => 'KW', 'flag' => '🇰🇼'],
            ['country' => 'قطر', 'code' => 'QA', 'flag' => '🇶🇦'],
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate(
                ['country' => $country['country']],
                [
                    'country' => $country['country'],
                    'status' => 1,
                    'country_code' => $country['code'],
                    'flag' => $country['flag'],
                ]
            );
        }

        return $saudiArabia;
    }

    private function createCities($country)
    {
        $citiesData = [
            ['name' => 'مكة المكرمة', 'status' => 1],
            ['name' => 'المدينة المنورة', 'status' => 1],
            ['name' => 'الرياض', 'status' => 1],
            ['name' => 'جدة', 'status' => 1],
            ['name' => 'الدمام', 'status' => 1],
            ['name' => 'الطائف', 'status' => 1],
        ];

        $cities = collect();

        foreach ($citiesData as $cityData) {
            $city = ServiceCity::firstOrCreate(
                ['service_city' => $cityData['name']],
                [
                    'service_city' => $cityData['name'],
                    'country_id' => $country->id,
                    'status' => $cityData['status'],
                ]
            );
            $cities->push($city);
        }

        return $cities;
    }

    private function createRegions($cities)
    {
        $regionsData = [
            'مكة المكرمة' => ['العزيزية', 'الزاهر', 'الشبيكة', 'العوالي', 'المنصور', 'الزاهر', 'العتيبية'],
            'المدينة المنورة' => ['قباء', 'العوالي', 'العيون', 'المناخة', 'الخالدية'],
            'الرياض' => ['العليا', 'الملك فهد', 'الملز', 'النرجس', 'الروضة'],
            'جدة' => ['الكورنيش', 'الزهراء', 'الروابي', 'السلامة', 'الفيصلية'],
        ];

        $regions = collect();

        foreach ($cities as $city) {
            if (isset($regionsData[$city->service_city])) {
                foreach ($regionsData[$city->service_city] as $regionName) {
                    $region = Region::firstOrCreate(
                        ['name_ar' => $regionName, 'city_id' => $city->id],
                        [
                            'name_ar' => $regionName,
                            'name_en' => Str::slug($regionName),
                            'city_id' => $city->id,
                            'is_active' => 1,
                        ]
                    );
                    $regions->push($region);
                }
            }
        }

        return $regions;
    }

    private function createCategories()
    {
        $categoriesData = [
            ['name' => 'صيانة تكييف', 'icon' => 'ti-settings'],
            ['name' => 'صيانة كهرباء', 'icon' => 'ti-bolt'],
            ['name' => 'صيانة سباكة', 'icon' => 'ti-drop'],
            ['name' => 'صيانة أجهزة منزلية', 'icon' => 'ti-home'],
            ['name' => 'صيانة أجهزة إلكترونية', 'icon' => 'ti-desktop'],
            ['name' => 'صيانة سيارات', 'icon' => 'ti-car'],
            ['name' => 'نظافة', 'icon' => 'ti-brush'],
            ['name' => 'دهان', 'icon' => 'ti-paint-bucket'],
        ];

        $categories = collect();

        foreach ($categoriesData as $catData) {
            $category = Category::firstOrCreate(
                ['name' => $catData['name']],
                [
                    'name' => $catData['name'],
                    'slug' => Str::slug($catData['name']),
                    'icon' => $catData['icon'],
                    'status' => 1,
                ]
            );
            $categories->push($category);
        }

        return $categories;
    }

    private function createSubcategories($categories)
    {
        $subcategoriesData = [
            'صيانة تكييف' => ['صيانة مكيف سبليت', 'صيانة مكيف شباك', 'صيانة مكيف مركزي', 'تنظيف مكيف'],
            'صيانة كهرباء' => ['صيانة كهرباء منزلية', 'تركيب مفتاح', 'إصلاح دائرة كهربائية', 'تركيب لمبات'],
            'صيانة سباكة' => ['صيانة سباكة عامة', 'إصلاح تسرب مياه', 'تركيب حنفية', 'تنظيف مجاري'],
            'صيانة أجهزة منزلية' => ['صيانة غسالة', 'صيانة ثلاجة', 'صيانة فرن', 'صيانة مكيف'],
            'صيانة أجهزة إلكترونية' => ['صيانة تلفزيون', 'صيانة لابتوب', 'صيانة هاتف', 'صيانة طابعة'],
        ];

        $subcategories = collect();

        foreach ($categories as $category) {
            if (isset($subcategoriesData[$category->name])) {
                foreach ($subcategoriesData[$category->name] as $subName) {
                    $subcategory = Subcategory::firstOrCreate(
                        ['name' => $subName, 'category_id' => $category->id],
                        [
                            'name' => $subName,
                            'category_id' => $category->id,
                            'status' => 1,
                        ]
                    );
                    $subcategories->push($subcategory);
                }
            }
        }

        return $subcategories;
    }

    private function createServices($categories, $subcategories, $cities, $country)
    {
        $services = collect();

        foreach ($categories as $category) {
            $categorySubs = $subcategories->where('category_id', $category->id);
            
            for ($i = 0; $i < rand(3, 6); $i++) {
                $subcategory = $categorySubs->random();
                $city = $cities->random();

                $service = Service::create([
                    'title' => $subcategory->name . ' - خدمة ' . ($i + 1),
                    'category_id' => $category->id,
                    'subcategory_id' => $subcategory->id,
                    'price' => rand(50, 500),
                    'seller_id' => 1,
                    'status' => 1,
                    'is_service_on' => 1,
                    'city' => $city->id,
                    'country' => $country->id,
                    'is_service_all_cities' => rand(0, 1),
                    'delivery_days' => rand(1, 7),
                    'sold_count' => rand(0, 100),
                ]);

                $services->push($service);
            }
        }

        return $services;
    }

    private function createAdmins()
    {
        $admins = collect();

        for ($i = 0; $i < 3; $i++) {
            $admin = Admin::firstOrCreate(
                ['email' => 'admin' . ($i + 1) . '@example.com'],
                [
                    'name' => 'مدير ' . ($i + 1),
                    'username' => 'admin' . ($i + 1),
                    'email' => 'admin' . ($i + 1) . '@example.com',
                    'password' => Hash::make('password'),
                ]
            );
            $admins->push($admin);
        }

        return $admins;
    }

    private function createSupportAgents($cities, $country)
    {
        $role = Role::where('name', 'Support')->first();
        $agents = collect();

        for ($i = 0; $i < 5; $i++) {
            $agent = User::create([
                'name' => 'وكيل دعم ' . ($i + 1),
                'username' => 'support' . ($i + 1),
                'email' => 'support' . ($i + 1) . '@example.com',
                'phone' => '05' . rand(10000000, 99999999),
                'password' => Hash::make('password'),
                'user_type' => 0,
                'user_status' => 1,
                'country' => $country->id,
                'city' => $cities->random()->id,
            ]);

            if ($role) {
                $agent->assignRole($role);
            }

            $agents->push($agent);
        }

        return $agents;
    }

    private function createFinanceAgents($cities, $country)
    {
        $role = Role::where('name', 'Finance')->first();
        $agents = collect();

        for ($i = 0; $i < 3; $i++) {
            $agent = User::create([
                'name' => 'وكيل مالي ' . ($i + 1),
                'username' => 'finance' . ($i + 1),
                'email' => 'finance' . ($i + 1) . '@example.com',
                'phone' => '05' . rand(10000000, 99999999),
                'password' => Hash::make('password'),
                'user_type' => 0,
                'user_status' => 1,
                'country' => $country->id,
                'city' => $cities->random()->id,
            ]);

            if ($role) {
                $agent->assignRole($role);
            }

            $agents->push($agent);
        }

        return $agents;
    }

    private function createQualityAgents($cities, $country)
    {
        $role = Role::where('name', 'Quality')->first();
        $agents = collect();

        for ($i = 0; $i < 3; $i++) {
            $agent = User::create([
                'name' => 'وكيل جودة ' . ($i + 1),
                'username' => 'quality' . ($i + 1),
                'email' => 'quality' . ($i + 1) . '@example.com',
                'phone' => '05' . rand(10000000, 99999999),
                'password' => Hash::make('password'),
                'user_type' => 0,
                'user_status' => 1,
                'country' => $country->id,
                'city' => $cities->random()->id,
            ]);

            if ($role) {
                $agent->assignRole($role);
            }

            $agents->push($agent);
        }

        return $agents;
    }

    private function createClients($regions, $cities, $country)
    {
        $role = Role::where('name', 'Client')->first();
        $clients = collect();

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
            'عبدالرحيم محمد العتيبي', 'عبدالغني فهد القحطاني', 'عبدالرزاق سعد الحربي',
        ];

        foreach ($arabicNames as $index => $name) {
            $region = $regions->random();
            $city = $cities->random();

            $client = User::create([
                'name' => $name,
                'username' => 'client_' . Str::slug($name) . '_' . $index,
                'email' => 'client' . ($index + 1) . '@example.com',
                'phone' => '05' . rand(10000000, 99999999),
                'password' => Hash::make('password'),
                'user_type' => 0,
                'user_status' => 1,
                'country' => $country->id,
                'city' => $city->id,
                'address' => 'منطقة ' . $region->name_ar . '، ' . $city->service_city,
                'post_code' => rand(20000, 29999),
            ]);

            if ($role) {
                $client->assignRole($role);
            }

            $clients->push($client);
        }

        return $clients;
    }

    private function createTechnicians($regions, $cities, $country)
    {
        $role = Role::where('name', 'Technician')->first();
        $technicians = collect();

        $technicianNames = [
            'فني محمد العتيبي', 'فني فهد القحطاني', 'فني عبدالله الحربي',
            'فني سعد الزهراني', 'فني خالد الدوسري', 'فني عمر الشهري',
            'فني يوسف المطيري', 'فني أحمد الغامدي', 'فني علي الجهني',
            'فني حسام الثقفي', 'فني ماجد العسيري', 'فني بندر البقمي',
            'فني سلطان القرني', 'فني نايف السبيعي', 'فني تركي العنزي',
        ];

        foreach ($technicianNames as $index => $name) {
            $city = $cities->random();
            $assignedRegions = $regions->where('city_id', $city->id)->random(rand(2, 5))->pluck('id')->toArray();

            $technician = User::create([
                'name' => $name,
                'username' => 'tech_' . Str::slug($name) . '_' . $index,
                'email' => 'tech' . ($index + 1) . '@example.com',
                'phone' => '05' . rand(10000000, 99999999),
                'password' => Hash::make('password'),
                'user_type' => 1,
                'user_status' => 1,
                'country' => $country->id,
                'city' => $city->id,
                'address' => $city->service_city,
                'is_available' => rand(0, 1),
                'rating' => rand(40, 50) / 10,
                'completed_orders_count' => rand(10, 100),
                'assigned_regions' => json_encode($assignedRegions),
            ]);

            if ($role) {
                $technician->assignRole($role);
            }

            if (method_exists($technician, 'regions')) {
                $technician->regions()->sync($assignedRegions);
            }

            $technicians->push($technician);
        }

        return $technicians;
    }

    private function createOrders($clients, $technicians, $services, $regions, $cities, $country, $supportAgents)
    {
        $orders = collect();
        $statuses = [0, 1, 2, 3, 4]; // pending, active, completed, delivered, cancelled
        $urgencyLevels = ['normal', 'urgent', 'emergency'];
        $paymentStatuses = ['pending', 'complete'];
        $paymentGateways = ['cash', 'bank_transfer', 'wallet'];

        $issueDescriptions = [
            'مكيف لا يعمل', 'تسرب مياه', 'مفتاح كهربائي معطل',
            'غسالة لا تعمل', 'ثلاجة لا تبرد', 'تلفزيون لا يعمل',
            'مكيف يخرج هواء ساخن', 'تسرب في الحمام', 'انقطاع كهرباء',
            'مكيف يصدر صوت عالي', 'مياه ساخنة لا تعمل', 'مصباح لا يعمل',
        ];

        for ($i = 0; $i < 100; $i++) {
            $client = $clients->random();
            $service = $services->random();
            $city = $cities->random();
            $region = $regions->where('city_id', $city->id)->first() ?? $regions->random();
            $technician = rand(0, 1) ? $technicians->random() : null;
            $supportAgent = $supportAgents->random();

            $status = $statuses[array_rand($statuses)];
            $packageFee = $service->price;
            $extraService = rand(0, 200);
            $subTotal = $packageFee + $extraService;
            $tax = $subTotal * 0.15;
            $total = $subTotal + $tax;

            $orderDate = Carbon::now()->subDays(rand(0, 60));
            $assignedAt = $technician ? $orderDate->copy()->addHours(rand(1, 5)) : null;
            $acceptedAt = ($technician && $status >= 1) ? ($assignedAt ? $assignedAt->copy()->addHours(rand(1, 3)) : null) : null;
            $completedAt = ($status >= 2) ? $orderDate->copy()->addDays(rand(1, 3)) : null;

            $order = Order::create([
                'invoice' => 'INV-' . strtoupper(Str::random(8)),
                'service_id' => $service->id,
                'seller_id' => $technician ? $technician->id : null,
                'buyer_id' => $client->id,
                'name' => $client->name,
                'email' => $client->email,
                'phone' => $client->phone,
                'post_code' => $client->post_code ?? rand(20000, 29999),
                'address' => $client->address ?? 'عنوان ' . $region->name_ar,
                'city' => $city->id,
                'area' => null,
                'country' => $country->id,
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
                'warranty_days' => $status >= 2 ? rand(30, 365) : null,
                'has_warranty' => $status >= 2,
                'assigned_by' => $supportAgent->id,
                'assigned_at' => $assignedAt,
                'accepted_at' => $acceptedAt,
                'completed_at' => $completedAt,
                'is_order_online' => 0,
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            if ($status >= 2) {
                $order->invoice_number = 'INV-' . date('Y') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
                $order->invoice_date = $completedAt ? $completedAt->format('Y-m-d') : Carbon::now()->format('Y-m-d');
                $order->save();
            }

            $orders->push($order);
        }

        return $orders;
    }

    private function createQualityFollowups($orders, $qualityAgents)
    {
        $completedOrders = $orders->where('status', 2);

        foreach ($completedOrders->take(30) as $order) {
            QualityFollowup::create([
                'order_id' => $order->id,
                'created_by' => $qualityAgents->random()->id,
                'rating' => rand(3, 5),
                'notes' => 'متابعة جودة الخدمة المقدمة',
                'client_feedback' => 'الخدمة كانت جيدة',
                'technician_feedback' => 'تم إنجاز العمل بنجاح',
                'status' => ['pending', 'completed', 'needs_improvement'][rand(0, 2)],
                'created_at' => $order->completed_at ?? Carbon::now(),
            ]);
        }
    }

    private function createReviews($orders, $clients)
    {
        $completedOrders = $orders->where('status', 2);

        foreach ($completedOrders->take(40) as $order) {
            Review::create([
                'service_id' => $order->service_id,
                'user_id' => $order->buyer_id,
                'order_id' => $order->id,
                'rating' => rand(3, 5),
                'message' => 'خدمة ممتازة ومهنية',
                'status' => 1,
                'created_at' => $order->completed_at ?? Carbon::now(),
            ]);
        }
    }

    private function createSupportTickets($clients, $supportAgents)
    {
        $priorities = ['low', 'medium', 'high', 'urgent'];
        $statuses = ['open', 'pending', 'closed', 'solved'];

        for ($i = 0; $i < 20; $i++) {
            $client = $clients->random();
            $supportAgent = $supportAgents->random();

            $ticket = SupportTicket::create([
                'title' => 'مشكلة في الطلب #' . rand(1, 100),
                'via' => 'website',
                'operating_system' => null,
                'user_agent' => null,
                'description' => 'وصف المشكلة بالتفصيل',
                'subject' => 'استفسار عن الطلب',
                'status' => $statuses[array_rand($statuses)],
                'priority' => $priorities[array_rand($priorities)],
                'user_id' => $client->id,
                'admin_id' => $supportAgent->id,
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
            ]);

            // إنشاء رسائل للتذكرة
            SupportTicketMessage::create([
                'support_ticket_id' => $ticket->id,
                'type' => 'user',
                'message' => 'رسالة من العميل',
                'notify' => 'on',
                'created_at' => $ticket->created_at,
            ]);

            if ($ticket->status != 'open') {
                SupportTicketMessage::create([
                    'support_ticket_id' => $ticket->id,
                    'type' => 'admin',
                    'message' => 'رد من فريق الدعم',
                    'notify' => 'on',
                    'created_at' => $ticket->created_at->copy()->addHours(rand(1, 24)),
                ]);
            }
        }
    }
}

