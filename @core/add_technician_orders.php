<?php

/**
 * سكريبت لإضافة بيانات وهمية لطلبات التقني
 * استخدم: php add_technician_orders.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use App\User;
use App\Service;
use App\ServiceCity;
use App\ServiceArea;
use App\Country;
use Carbon\Carbon;

echo "بدء إضافة البيانات الوهمية...\n";

try {
    DB::beginTransaction();

    // الحصول على تقني موجود أو إنشاء واحد
    $technician = User::whereHas('roles', function($q) {
        $q->where('name', 'Technician');
    })->first();

    if (!$technician) {
        // البحث عن أي seller
        $technician = User::where('user_type', 0)->first();
        
        if (!$technician) {
            // إنشاء تقني جديد
            $technician = User::create([
                'name' => 'أحمد محمد التقني',
                'email' => 'technician@example.com',
                'username' => 'technician1',
                'password' => bcrypt('password'),
                'phone' => '0501234567',
                'user_type' => 0,
                'user_status' => 1,
                'is_available' => true,
                'technician_code' => 'TECH001',
                'rating' => 4.5,
                'completed_orders_count' => 0,
            ]);
            
            // تعيين دور التقني إذا كان موجوداً
            try {
                $technician->assignRole('Technician');
            } catch (\Exception $e) {
                echo "تحذير: لم يتم تعيين دور التقني - " . $e->getMessage() . "\n";
            }
        }
    }

    echo "التقني: {$technician->name} (ID: {$technician->id})\n";

    // الحصول على خدمات
    $services = Service::where('status', 1)->limit(10)->get();
    
    if ($services->isEmpty()) {
        throw new \Exception('لا توجد خدمات في قاعدة البيانات. يرجى إضافة خدمات أولاً.');
    }

    echo "عدد الخدمات المتاحة: {$services->count()}\n";

    // الحصول على عملاء
    $clients = User::where('user_type', 1)->limit(5)->get();
    
    if ($clients->isEmpty()) {
        // إنشاء عملاء
        for ($i = 1; $i <= 5; $i++) {
            $clients->push(User::create([
                'name' => "عميل {$i}",
                'email' => "client{$i}@example.com",
                'username' => "client{$i}",
                'password' => bcrypt('password'),
                'phone' => '050' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'user_type' => 1,
                'user_status' => 1,
            ]));
        }
        echo "تم إنشاء 5 عملاء جديدين\n";
    }

    // الحصول على مدن ومناطق
    $city = ServiceCity::first();
    $area = ServiceArea::first();
    $country = Country::first();

    $orderStatuses = [
        ['status' => 0, 'name' => 'قيد الانتظار', 'count' => 5],
        ['status' => 1, 'name' => 'نشط', 'count' => 8],
        ['status' => 2, 'name' => 'مكتمل', 'count' => 7],
    ];

    $urgencyLevels = ['low', 'medium', 'high'];
    $paymentStatuses = ['pending', 'completed', 'failed'];
    $paymentGateways = ['cash', 'bank_transfer', 'online'];

    $orderCounter = 1;
    $totalCreated = 0;

    foreach ($orderStatuses as $statusData) {
        for ($i = 0; $i < $statusData['count']; $i++) {
            $service = $services->random();
            $client = $clients->random();
            
            $packageFee = rand(100, 500);
            $extraService = rand(0, 200);
            $subTotal = $packageFee + $extraService;
            $tax = round($subTotal * 0.15, 2);
            $total = $subTotal + $tax;

            $invoice = 'INV-' . date('Y') . '-' . str_pad($orderCounter, 6, '0', STR_PAD_LEFT);
            $trackingCode = 'TRK-' . strtoupper(uniqid());

            $assignedAt = Carbon::now()->subDays(rand(1, 30));
            $acceptedAt = $statusData['status'] >= 1 ? $assignedAt->copy()->addHours(rand(1, 24)) : null;
            $completedAt = $statusData['status'] == 2 ? ($acceptedAt ? $acceptedAt->copy()->addDays(rand(1, 5)) : $assignedAt->copy()->addDays(rand(1, 5))) : null;

            $orderData = [
                'invoice' => $invoice,
                'service_id' => $service->id,
                'seller_id' => $technician->id,
                'buyer_id' => $client->id,
                'name' => $client->name,
                'email' => $client->email,
                'phone' => $client->phone ?? '0501234567',
                'post_code' => str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT),
                'address' => 'شارع ' . rand(1, 100) . '، حي ' . ['النزهة', 'الروضة', 'العليا', 'الملز', 'العليا'][rand(0, 4)],
                'city' => $city ? $city->id : 1,
                'area' => $area ? $area->id : 1,
                'country' => $country ? $country->id : 1,
                'date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'schedule' => ['صباحاً', 'ظهراً', 'مساءً'][rand(0, 2)],
                'package_fee' => $packageFee,
                'extra_service' => $extraService,
                'sub_total' => $subTotal,
                'tax' => $tax,
                'total' => $total,
                'payment_gateway' => $paymentGateways[rand(0, 2)],
                'payment_status' => $statusData['status'] == 2 ? 'completed' : $paymentStatuses[rand(0, 2)],
                'status' => $statusData['status'],
                'order_note' => 'ملاحظات الطلب: ' . ['صيانة عادية', 'صيانة عاجلة', 'فحص شامل', 'إصلاح عطل'][rand(0, 3)],
                'is_order_online' => rand(0, 1),
                'tracking_code' => $trackingCode,
                'urgency_level' => $urgencyLevels[rand(0, 2)],
                'assigned_at' => $assignedAt,
                'accepted_at' => $acceptedAt,
                'completed_at' => $completedAt,
                'created_at' => $assignedAt,
                'updated_at' => $completedAt ?? $acceptedAt ?? $assignedAt,
            ];

            if ($statusData['status'] == 2) {
                $orderData['warranty_code'] = 'WAR-' . strtoupper(uniqid());
                $orderData['warranty_days'] = rand(30, 365);
                $orderData['has_warranty'] = true;
            }

            \App\Order::create($orderData);
            $orderCounter++;
            $totalCreated++;
        }
    }

    DB::commit();
    
    echo "\n✅ تم إنشاء {$totalCreated} طلب وهمي بنجاح!\n";
    echo "التقني: {$technician->name}\n";
    echo "يمكنك الآن زيارة: http://localhost/SyanTeck/technician/orders\n";
    
} catch (\Exception $e) {
    DB::rollBack();
    echo "\n❌ خطأ: " . $e->getMessage() . "\n";
    echo "السطر: " . $e->getLine() . " في الملف: " . $e->getFile() . "\n";
    exit(1);
}

