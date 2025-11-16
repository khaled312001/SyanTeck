<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\ServiceCity;
use App\Country;
use App\Region;

class UpdateMakkahRegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== Updating Makkah Regions ===');
        $this->command->info('');

        // الحصول على السعودية
        $saudiArabia = Country::where('country', 'Saudi Arabia')
            ->orWhere('country', 'السعودية')
            ->orWhere('country', 'المملكة العربية السعودية')
            ->orWhere('country', 'Saudi')
            ->first();

        if (!$saudiArabia) {
            $saudiArabia = Country::first();
            if (!$saudiArabia) {
                $saudiArabia = Country::create([
                    'country' => 'السعودية',
                    'status' => 1,
                    'country_code' => 'SA',
                ]);
                $this->command->info('✓ Created Saudi Arabia country');
            }
        }

        // الحصول على مكة
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

        // قائمة المناطق المطلوبة فقط
        $makkahRegions = [
            // أولاً: أحياء شرق مكة
            'الشرائع',
            'الشرائع مخطط 1',
            'الشرائع مخطط 2',
            'الشرائع مخطط 3',
            'الشرائع مخطط 4',
            'الشرائع مخطط 5',
            'الشرائع مخطط 6',
            'الشرائع مخطط 7',
            'الشرائع مخطط 8',
            'الشرائع مخطط 9',
            'الشرائع مخطط 10',
            'الشرائع مخطط 11',
            'الراشدية',
            'الريان',
            'المنتزهات',
            'العسيلة',
            'الجمعة',
            'التنعيم الشرقي',
            
            // ثانياً: أحياء شمال مكة
            'العزيزية الشمالية',
            'الكعكية',
            'الخالدية',
            'حي النسيم',
            'حي الشوقية الشمالية',
            'حي العدل',
            'المعابدة',
            'جرول',
            'الرصيفة',
            
            // ثالثاً: أحياء جنوب مكة
            'كدي',
            'بطحاء قريش',
            'الهجرة',
            'الزهراء',
            'حي النوارية الجنوبية',
            
            // رابعاً: أحياء قريبة من الحرم
            'الحفاير',
            'المسفلة',
            'الهجلة',
            'أجياد',
            'القرارة',
            'جبل عمر',
            'الشامية',
            
            // خامساً: أحياء غرب مكة
            'الزاهر',
            'الزاهية',
            'الاسكان',
            'حي الشرائع الغربية',
            'حي التخصصي',
            
            // سادساً: ضواحي مكة والمخططات الجديدة
            'مخطط ولي العهد 1',
            'مخطط ولي العهد 2',
            'مخطط ولي العهد 3',
            'مخطط ولي العهد 4',
            'مخطط ولي العهد 5',
            'مخطط ولي العهد 6',
            'مخطط ولي العهد 7',
            'مخطط ولي العهد 8',
            'مخطط ولي العهد 9',
            'النوارية',
            'العمرة',
            'النزاوي',
            'الزايدي',
            'عمرة الجديدة',
            'الفيحاء',
        ];

        // إزالة التكرارات
        $makkahRegions = array_unique($makkahRegions);

        // حذف جميع المناطق القديمة في مكة
        $deletedCount = Region::where('city_id', $makkahCity->id)->delete();
        $this->command->info("✓ Deleted {$deletedCount} old regions");

        $addedCount = 0;

        foreach ($makkahRegions as $regionName) {
            Region::create([
                'name' => $regionName,
                'name_ar' => $regionName,
                'description' => "منطقة {$regionName} في مكة المكرمة",
                'city_id' => $makkahCity->id,
                'is_active' => true,
            ]);
            $addedCount++;
            $this->command->info("  ✓ Added: {$regionName}");
        }

        $this->command->info('');
        $this->command->info("✓ Added {$addedCount} new regions");
        $this->command->info("✓ Total regions in Makkah: " . Region::where('city_id', $makkahCity->id)->count());
        $this->command->info('');
    }
}

