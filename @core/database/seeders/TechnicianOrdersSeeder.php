<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Order;
use App\User;
use App\Service;
use App\ServiceCity;
use App\ServiceArea;
use App\Country;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TechnicianOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // الحصول على تقني موجود أو إنشاء واحد
        $technician = User::whereHas('roles', function($q) {
            $q->where('name', 'Technician');
        })->first();

        if (!$technician) {
            // إنشاء تقني جديد إذا لم يوجد
            $technician = User::create([
                'name' => 'أحمد محمد التقني',
                'email' => 'technician@example.com',
                'username' => 'technician1',
                'password' => bcrypt('password'),
                'phone' => '0501234567',
                'user_type' => 0, // seller
                'user_status' => 1,
                'is_available' => true,
                'technician_code' => 'TECH001',
                'rating' => 4.5,
                'completed_orders_count' => 0,
            ]);
            
            // تعيين دور التقني
            $technician->assignRole('Technician');
        }

        // الحصول على خدمات موجودة
        $services = Service::where('status', 1)->limit(10)->get();
        
        if ($services->isEmpty()) {
            $this->command->warn('لا توجد خدمات في قاعدة البيانات. يرجى إضافة خدمات أولاً.');
            return;
        }

        // الحصول على عملاء موجودين أو إنشاء عملاء
        $clients = User::where('user_type', 1)->limit(5)->get();
        
        if ($clients->isEmpty()) {
            // إنشاء عملاء وهميين
            for ($i = 1; $i <= 5; $i++) {
                $clients->push(User::create([
                    'name' => "عميل {$i}",
                    'email' => "client{$i}@example.com",
                    'username' => "client{$i}",
                    'password' => bcrypt('password'),
                    'phone' => '050' . str_pad($i, 7, '0', STR_PAD_LEFT),
                    'user_type' => 1, // buyer
                    'user_status' => 1,
                ]));
            }
        }

        // الحصول على مدن ومناطق
        $city = ServiceCity::first();
        $area = ServiceArea::first();
        $country = Country::first();

        // بيانات وهمية للطلبات
        $orderStatuses = [
            ['status' => 0, 'name' => 'قيد الانتظار', 'count' => 5],
            ['status' => 1, 'name' => 'نشط', 'count' => 8],
            ['status' => 2, 'name' => 'مكتمل', 'count' => 7],
        ];

        $urgencyLevels = ['low', 'medium', 'high'];
        $paymentStatuses = ['pending', 'completed', 'failed'];
        $paymentGateways = ['cash', 'bank_transfer', 'online'];

        $orderCounter = 1;

        foreach ($orderStatuses as $statusData) {
            for ($i = 0; $i < $statusData['count']; $i++) {
                $service = $services->random();
                $client = $clients->random();
                
                $packageFee = rand(100, 500);
                $extraService = rand(0, 200);
                $subTotal = $packageFee + $extraService;
                $tax = $subTotal * 0.15; // 15% ضريبة
                $total = $subTotal + $tax;

                // إنشاء رقم فاتورة
                $invoice = 'INV-' . date('Y') . '-' . str_pad($orderCounter, 6, '0', STR_PAD_LEFT);
                
                // إنشاء كود تتبع
                $trackingCode = 'TRK-' . strtoupper(uniqid());

                // تحديد التواريخ حسب الحالة
                $assignedAt = Carbon::now()->subDays(rand(1, 30));
                $acceptedAt = $statusData['status'] >= 1 ? $assignedAt->copy()->addHours(rand(1, 24)) : null;
                $completedAt = $statusData['status'] == 2 ? $acceptedAt->copy()->addDays(rand(1, 5)) : null;

                $order = Order::create([
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
                    'warranty_code' => $statusData['status'] == 2 ? 'WAR-' . strtoupper(uniqid()) : null,
                    'warranty_days' => $statusData['status'] == 2 ? rand(30, 365) : null,
                    'has_warranty' => $statusData['status'] == 2 ? true : false,
                    'region_id' => null,
                    'notes' => 'ملاحظات إضافية للطلب رقم ' . $orderCounter,
                    'urgency_level' => $urgencyLevels[rand(0, 2)],
                    'assigned_at' => $assignedAt,
                    'accepted_at' => $acceptedAt,
                    'completed_at' => $completedAt,
                    'created_at' => $assignedAt,
                    'updated_at' => $completedAt ?? $acceptedAt ?? $assignedAt,
                ]);

                $orderCounter++;
            }
        }

        $this->command->info('تم إنشاء ' . ($orderCounter - 1) . ' طلب وهمي بنجاح للتقني: ' . $technician->name);
    }
}

