<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Service;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // كلمات البحث للخدمات المطلوبة (الكهرباء والسباكة والتكييف)
        $serviceKeywords = [
            'كهرباء', 'كهربائي', 'electrical', 'electricity', 'electric',
            'سباكة', 'سباك', 'plumbing', 'plumber', 'plumb',
            'تكييف', 'مكيف', 'air conditioning', 'ac', 'air conditioner', 'cooling'
        ];
        
        // البحث عن الخدمات التي يجب الاحتفاظ بها
        $servicesToKeep = Service::where(function($query) use ($serviceKeywords) {
            foreach ($serviceKeywords as $index => $keyword) {
                if ($index === 0) {
                    $query->where('title', 'like', '%' . $keyword . '%');
                } else {
                    $query->orWhere('title', 'like', '%' . $keyword . '%');
                }
            }
        })->pluck('id')->toArray();
        
        // حذف جميع الخدمات ما عدا الخدمات المطلوبة
        if (!empty($servicesToKeep)) {
            Service::whereNotIn('id', $servicesToKeep)->delete();
        } else {
            // إذا لم توجد خدمات مطابقة، حذف جميع الخدمات
            Service::query()->delete();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // لا يمكن استرجاع الخدمات المحذوفة
    }
};
