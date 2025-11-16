<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateOrderSuccessPageTextsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== تحديث نصوص صفحة نجاح الطلب ===');
        $this->command->info('');

        // تحديث النصوص
        $texts = [
            'success_title' => 'تم الطلب',
            'success_subtitle' => 'تم إكمال طلبك بنجاح',
            'success_details_title' => 'تفاصيل طلبك',
            'button_title' => 'العودة للصفحة الرئيسية',
        ];
        
        // تحديث رابط الزر للصفحة الرئيسية
        // استخدام route helper للحصول على URL الصحيح
        try {
            $homepageUrl = route('homepage');
            $texts['button_url'] = $homepageUrl;
        } catch (\Exception $e) {
            // إذا فشل route helper، استخدم URL افتراضي
            $texts['button_url'] = '/';
        }

        foreach ($texts as $key => $value) {
            try {
                $exists = DB::table('static_options')->where('option_name', $key)->exists();
                
                if ($exists) {
                    DB::table('static_options')
                        ->where('option_name', $key)
                        ->update(['option_value' => $value]);
                    $this->command->info("✓ تم تحديث: {$key} → {$value}");
                } else {
                    DB::table('static_options')->insert([
                        'option_name' => $key,
                        'option_value' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $this->command->info("✓ تم إضافة: {$key} → {$value}");
                }
            } catch (\Exception $e) {
                $this->command->error("❌ خطأ في تحديث {$key}: " . $e->getMessage());
            }
        }

        $this->command->info('');
        $this->command->info('✓ تم تحديث جميع النصوص بنجاح!');
        $this->command->info('');
    }
}

