<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\ServiceCity;
use App\Country;
use App\Region;

class AddMakkahRegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== Adding Makkah City and Regions ===');
        $this->command->info('');

        // الحصول على السعودية كدولة (أو إنشاؤها)
        $saudiArabia = Country::where('country', 'Saudi Arabia')
            ->orWhere('country', 'السعودية')
            ->orWhere('country', 'المملكة العربية السعودية')
            ->orWhere('country', 'Saudi')
            ->first();

        if (!$saudiArabia) {
            // البحث عن أي دولة موجودة أو استخدام ID افتراضي
            $saudiArabia = Country::first();
            if (!$saudiArabia) {
                // إنشاء السعودية إذا لم تكن موجودة
                $saudiArabia = Country::create([
                    'country' => 'السعودية',
                    'status' => 1,
                    'country_code' => 'SA',
                ]);
                $this->command->info('✓ Created Saudi Arabia country');
            } else {
                $this->command->warn('Using first available country (ID: ' . $saudiArabia->id . ')');
            }
        }

        // إضافة مكة كمدينة
        $makkahCity = ServiceCity::where('service_city', 'مكة')
            ->orWhere('service_city', 'Makkah')
            ->orWhere('service_city', 'Mecca')
            ->orWhere('service_city', 'مكة المكرمة')
            ->first();

        if (!$makkahCity) {
            $makkahCity = ServiceCity::create([
                'service_city' => 'مكة المكرمة',
                'country_id' => $saudiArabia->id,
                'status' => 1,
            ]);
            $this->command->info('✓ Created Makkah city');
        } else {
            $makkahCity->service_city = 'مكة المكرمة';
            $makkahCity->status = 1;
            $makkahCity->save();
            $this->command->info('✓ Updated Makkah city');
        }

        // قائمة الأحياء والمناطق في مكة المكرمة (فقط أحياء مكة)
        $makkahRegions = [
            // المناطق الرئيسية في مكة
            'الشرائع',
            'العزيزية',
            'الزاهر',
            'العوالي',
            'الشوقية',
            'المسفلة',
            'العمرة',
            'الحرم',
            'العتيبية',
            'النسيم',
            'الرصيفة',
            'الخنساء',
            'الفلاح',
            'السلامة',
            'المنصور',
            'الروضة',
            'الفيصلية',
            'الزهراء',
            'النهضة',
            'الخالدية',
            'الجامعة',
            'الطندباوي',
            'الكرنتينة',
            'الجميزة',
            'الشميسي',
            'الجرول',
            'الراشدية',
            'الرحيب',
            'الرحيب القديم',
            'الرحيب الجديد',
            'الرحيب الشرقي',
            'الرحيب الغربي',
            'الرحيب الشمالي',
            'الرحيب الجنوبي',
            'الرحيب الأوسط',
            'الرحيب الأعلى',
            'الرحيب الأسفل',
            'الرحيب الأول',
            'الرحيب الثاني',
            'الرحيب الثالث',
            'الرحيب الرابع',
            'الرحيب الخامس',
            'الرحيب السادس',
            'الرحيب السابع',
            'الرحيب الثامن',
            'الرحيب التاسع',
            'الرحيب العاشر',
            'الرحيب الحادي عشر',
            'الرحيب الثاني عشر',
            'الرحيب الثالث عشر',
            'الرحيب الرابع عشر',
            'الرحيب الخامس عشر',
            'الرحيب السادس عشر',
            'الرحيب السابع عشر',
            'الرحيب الثامن عشر',
            'الرحيب التاسع عشر',
            'الرحيب العشرين',
            'الرحيب الواحد والعشرين',
            'الرحيب الثاني والعشرين',
            'الرحيب الثالث والعشرين',
            'الرحيب الرابع والعشرين',
            'الرحيب الخامس والعشرين',
            'الرحيب السادس والعشرين',
            'الرحيب السابع والعشرين',
            'الرحيب الثامن والعشرين',
            'الرحيب التاسع والعشرين',
            'الرحيب الثلاثين',
            'الرحيب الواحد والثلاثين',
            'الرحيب الثاني والثلاثين',
            'الرحيب الثالث والثلاثين',
            'الرحيب الرابع والثلاثين',
            'الرحيب الخامس والثلاثين',
            'الرحيب السادس والثلاثين',
            'الرحيب السابع والثلاثين',
            'الرحيب الثامن والثلاثين',
            'الرحيب التاسع والثلاثين',
            'الرحيب الأربعين',
            'الرحيب الواحد والأربعين',
            'الرحيب الثاني والأربعين',
            'الرحيب الثالث والأربعين',
            'الرحيب الرابع والأربعين',
            'الرحيب الخامس والأربعين',
            'الرحيب السادس والأربعين',
            'الرحيب السابع والأربعين',
            'الرحيب الثامن والأربعين',
            'الرحيب التاسع والأربعين',
            'الرحيب الخمسين',
        ];

        // إزالة التكرارات
        $makkahRegions = array_unique($makkahRegions);

        $addedCount = 0;
        $updatedCount = 0;

        foreach ($makkahRegions as $regionName) {
            $region = Region::where('name', $regionName)
                ->orWhere('name_ar', $regionName)
                ->first();

            if (!$region) {
                Region::create([
                    'name' => $regionName,
                    'name_ar' => $regionName,
                    'description' => "منطقة {$regionName} في مكة المكرمة",
                    'city_id' => $makkahCity->id,
                    'is_active' => true,
                ]);
                $addedCount++;
                $this->command->info("  ✓ Added: {$regionName}");
            } else {
                $region->name = $regionName;
                $region->name_ar = $regionName;
                $region->city_id = $makkahCity->id;
                $region->is_active = true;
                $region->save();
                $updatedCount++;
                $this->command->info("  ↻ Updated: {$regionName}");
            }
        }

        $this->command->info('');
        $this->command->info("✓ Added {$addedCount} new regions");
        $this->command->info("✓ Updated {$updatedCount} existing regions");
        $this->command->info("✓ Total regions in Makkah: " . Region::where('city_id', $makkahCity->id)->count());
        $this->command->info('');
    }
}
