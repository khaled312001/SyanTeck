<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Order;
use App\User;

class UpdateTechnicianEmailForOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== تحديث بريد الفني للطلب رقم 71 ===');
        $this->command->info('');

        // الحصول على الطلب رقم 71
        $order = Order::find(71);

        if (!$order) {
            $this->command->error('❌ لم يتم العثور على الطلب رقم 71!');
            return;
        }

        $this->command->info("✓ تم العثور على الطلب رقم 71");

        // التحقق من وجود فني مخصص
        if (!$order->seller_id) {
            $this->command->error('❌ لا يوجد فني مخصص لهذا الطلب!');
            return;
        }

        // الحصول على الفني
        $technician = User::find($order->seller_id);

        if (!$technician) {
            $this->command->error('❌ لم يتم العثور على الفني!');
            return;
        }

        $this->command->info("✓ الفني الحالي: {$technician->name} ({$technician->email})");

        // تحديث البريد الإلكتروني
        $technician->email = 'technician@syanteck.com';
        $technician->save();

        $this->command->info('');
        $this->command->info('✓ تم تحديث بريد الفني بنجاح!');
        $this->command->info("  الاسم: {$technician->name}");
        $this->command->info("  البريد الإلكتروني: {$technician->email}");
        $this->command->info('');
    }
}

