<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\StaticOption;

class UpdateTopBarSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('بدء تحديث إعدادات الشريط العلوي...');
        $this->command->info('');

        // تحديث البريد الإلكتروني
        $this->command->info('1. تحديث البريد الإلكتروني...');
        $this->updateOrCreateOption('site_global_email', 'info@syanatech.com');
        
        // إضافة/تحديث رقم الهاتف السعودي
        $this->command->info('2. تحديث رقم الهاتف...');
        $this->updateOrCreateOption('site_contact_phone', '+966 50 123 4567');
        
        // إضافة/تحديث روابط السوشيال ميديا
        $this->command->info('3. إضافة روابط السوشيال ميديا...');
        $socialLinks = [
            'site_facebook_link' => 'https://www.facebook.com/syanatech',
            'site_twitter_link' => 'https://www.twitter.com/syanatech',
            'site_instagram_link' => 'https://www.instagram.com/syanatech',
            'site_linkedin_link' => 'https://www.linkedin.com/company/syanatech',
            'site_youtube_link' => 'https://www.youtube.com/@syanatech',
            'site_whatsapp_link' => 'https://wa.me/966501234567',
        ];

        foreach ($socialLinks as $key => $value) {
            $this->updateOrCreateOption($key, $value);
        }

        $this->command->info('');
        $this->command->info('✓ تم تحديث جميع الإعدادات بنجاح!');
        $this->command->info('');
    }

    /**
     * Update or create static option
     */
    private function updateOrCreateOption($optionName, $optionValue)
    {
        try {
            $option = StaticOption::where('option_name', $optionName)->first();
            
            if ($option) {
                $option->option_value = $optionValue;
                $option->save();
                $this->command->info("  ✓ تم تحديث: {$optionName} → {$optionValue}");
            } else {
                StaticOption::create([
                    'option_name' => $optionName,
                    'option_value' => $optionValue,
                ]);
                $this->command->info("  ✓ تم إضافة: {$optionName} → {$optionValue}");
            }
        } catch (\Exception $e) {
            $this->command->error("  ❌ خطأ في تحديث {$optionName}: " . $e->getMessage());
        }
    }
}

