<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\User;
use App\ServiceCity;
use App\ServiceArea;
use App\Country;

class UpdateTechnicianDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('=== تحديث تفاصيل الفني ===');
        $this->command->info('');

        // البحث عن الفني بالبريد الإلكتروني
        $technician = User::where('email', 'demo@SyanTeck.com')
            ->orWhere('name', 'Test Seller')
            ->first();

        if (!$technician) {
            $this->command->error('❌ لم يتم العثور على الفني!');
            return;
        }

        $this->command->info("✓ تم العثور على الفني: {$technician->name} (ID: {$technician->id})");

        // الحصول على السعودية
        $saudiArabia = Country::where('country', 'Saudi Arabia')
            ->orWhere('country', 'السعودية')
            ->orWhere('country', 'المملكة العربية السعودية')
            ->orWhere('country', 'Saudi')
            ->first();

        if (!$saudiArabia) {
            $saudiArabia = Country::where('country_code', 'SA')->first();
            if (!$saudiArabia) {
                $this->command->error('❌ لم يتم العثور على السعودية في قاعدة البيانات!');
                return;
            }
        }

        // الحصول على مكة
        $makkahCity = ServiceCity::where('service_city', 'مكة')
            ->orWhere('service_city', 'Makkah')
            ->orWhere('service_city', 'Mecca')
            ->orWhere('service_city', 'مكة المكرمة')
            ->first();

        if (!$makkahCity) {
            $this->command->error('❌ لم يتم العثور على مكة في قاعدة البيانات!');
            return;
        }

        // الحصول على منطقة في مكة (أول منطقة متاحة)
        $makkahArea = ServiceArea::where('service_city_id', $makkahCity->id)->first();

        if (!$makkahArea) {
            // إنشاء منطقة افتراضية إذا لم توجد
            $makkahArea = ServiceArea::create([
                'service_area' => 'الشرائع',
                'service_city_id' => $makkahCity->id,
                'status' => 1,
            ]);
            $this->command->info('✓ تم إنشاء منطقة افتراضية: الشرائع');
        }

        // تحديث بيانات الفني
        $technician->update([
            'name' => 'فني تجريبي',
            'email' => 'demo@SyanTeck.com',
            'phone' => '+966501234567',
            'address' => 'الشرائع، مكة المكرمة، السعودية',
            'service_city' => $makkahCity->id,
            'service_area' => $makkahArea->id,
            'post_code' => '24231',
            'country_id' => $saudiArabia->id,
            'country_code' => 'SA',
            'seller_address' => 'الشرائع، مكة المكرمة، السعودية',
            'latitude' => '21.3891',
            'longitude' => '39.8579',
        ]);

        $this->command->info('');
        $this->command->info('✓ تم تحديث بيانات الفني بنجاح!');
        $this->command->info('');
        $this->command->info('التفاصيل المحدثة:');
        $this->command->info('  الاسم: فني تجريبي');
        $this->command->info('  البريد الإلكتروني: demo@SyanTeck.com');
        $this->command->info('  الهاتف: +966501234567');
        $this->command->info('  العنوان: الشرائع، مكة المكرمة، السعودية');
        $this->command->info('  المدينة: ' . $makkahCity->service_city);
        $this->command->info('  المنطقة: ' . $makkahArea->service_area);
        $this->command->info('  الرمز البريدي: 24231');
        $this->command->info('  الدولة: ' . $saudiArabia->country);
        $this->command->info('');
    }
}

