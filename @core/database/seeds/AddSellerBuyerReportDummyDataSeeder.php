<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Report;
use App\Order;
use App\User;
use App\Service;
use Carbon\Carbon;

class AddSellerBuyerReportDummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== إضافة بيانات وهمية لتقارير البائع والمشتري ===');
        $this->command->info('');

        // الحصول على بعض الطلبات
        $orders = Order::where('status', '!=', 4)->limit(10)->get();
        
        if ($orders->isEmpty()) {
            $this->command->error('❌ لا توجد طلبات في قاعدة البيانات!');
            return;
        }

        $this->command->info("✓ تم العثور على " . $orders->count() . " طلب");

        // نصوص تقارير وهمية
        $buyerReports = [
            'الفني لم يحضر في الموعد المحدد',
            'الخدمة المقدمة لم تكن كما هو متوقع',
            'الفني لم يكمل العمل بشكل صحيح',
            'المشكلة لم يتم حلها بشكل كامل',
            'الفني كان غير مهذب في التعامل',
            'الخدمة تأخرت كثيراً عن الموعد المحدد',
            'الفني لم يجلب الأدوات اللازمة',
            'جودة العمل لم تكن جيدة',
            'الفني طلب مبلغ إضافي غير متفق عليه',
            'الخدمة لم تكتمل كما هو مطلوب'
        ];

        $sellerReports = [
            'العميل لم يدفع المبلغ المتفق عليه',
            'العميل كان غير متعاون',
            'العميل غير مواعيد متعددة',
            'العميل لم يسمح بالدخول للمنزل',
            'العميل طلب خدمات إضافية بدون دفع',
            'العميل كان غير مهذب في التعامل',
            'العميل لم يقدم المعلومات اللازمة',
            'العميل رفض استلام الخدمة',
            'العميل طلب إلغاء الطلب بعد البدء بالعمل',
            'العميل لم يكن متاحاً في الموعد المحدد'
        ];

        $addedCount = 0;

        foreach ($orders as $order) {
            // التحقق من وجود تقرير بالفعل
            $existingReport = Report::where('order_id', $order->id)->first();
            
            if ($existingReport) {
                continue; // تخطي إذا كان هناك تقرير موجود
            }

            // إضافة تقرير من المشتري
            if ($order->buyer_id && $order->seller_id) {
                try {
                    Report::create([
                        'order_id' => $order->id,
                        'service_id' => $order->service_id ?? 1,
                        'seller_id' => $order->seller_id,
                        'buyer_id' => $order->buyer_id,
                        'report_from' => 'buyer',
                        'report_to' => 'seller',
                        'report' => $buyerReports[array_rand($buyerReports)],
                        'status' => 0,
                        'created_at' => Carbon::now()->subDays(rand(1, 30)),
                        'updated_at' => Carbon::now()->subDays(rand(1, 30)),
                    ]);
                    $addedCount++;
                    $this->command->info("  ✓ تم إضافة تقرير من المشتري للطلب #{$order->id}");
                } catch (\Exception $e) {
                    $this->command->warn("  ⚠ فشل إضافة تقرير للطلب #{$order->id}: " . $e->getMessage());
                }
            }

            // إضافة تقرير من البائع (50% من الوقت)
            if ($order->buyer_id && $order->seller_id && rand(0, 1) == 1) {
                try {
                    Report::create([
                        'order_id' => $order->id,
                        'service_id' => $order->service_id ?? 1,
                        'seller_id' => $order->seller_id,
                        'buyer_id' => $order->buyer_id,
                        'report_from' => 'seller',
                        'report_to' => 'buyer',
                        'report' => $sellerReports[array_rand($sellerReports)],
                        'status' => 0,
                        'created_at' => Carbon::now()->subDays(rand(1, 30)),
                        'updated_at' => Carbon::now()->subDays(rand(1, 30)),
                    ]);
                    $addedCount++;
                    $this->command->info("  ✓ تم إضافة تقرير من البائع للطلب #{$order->id}");
                } catch (\Exception $e) {
                    $this->command->warn("  ⚠ فشل إضافة تقرير للطلب #{$order->id}: " . $e->getMessage());
                }
            }
        }

        $this->command->info('');
        $this->command->info("✓ تم إضافة {$addedCount} تقرير بنجاح!");
        $this->command->info("✓ إجمالي التقارير في قاعدة البيانات: " . Report::count());
        $this->command->info('');
    }
}

