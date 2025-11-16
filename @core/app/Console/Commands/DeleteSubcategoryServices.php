<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Service;

class DeleteSubcategoryServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'services:delete-subcategory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all services that have subcategory_id or child_category_id (keep only main category services)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('جاري البحث عن الخدمات الفرعية...');
        
        // البحث عن الخدمات التي لها subcategory_id أو child_category_id
        $subcategoryServices = Service::whereNotNull('subcategory_id')
            ->orWhereNotNull('child_category_id')
            ->get();
        
        $count = $subcategoryServices->count();
        
        if ($count == 0) {
            $this->info('لا توجد خدمات فرعية لحذفها.');
            return Command::SUCCESS;
        }
        
        $this->warn("تم العثور على {$count} خدمة فرعية.");
        
        if ($this->confirm('هل أنت متأكد من حذف جميع الخدمات الفرعية؟', true)) {
            $deleted = 0;
            
            foreach ($subcategoryServices as $service) {
                try {
                    // حذف الخدمة وجميع البيانات المرتبطة بها
                    $service->delete();
                    $deleted++;
                } catch (\Exception $e) {
                    $this->error("خطأ في حذف الخدمة ID: {$service->id} - {$e->getMessage()}");
                }
            }
            
            $this->info("تم حذف {$deleted} خدمة فرعية بنجاح.");
            $this->info("تم الاحتفاظ بالخدمات الرئيسية فقط (التي لها category_id فقط).");
        } else {
            $this->info('تم إلغاء العملية.');
        }
        
        return Command::SUCCESS;
    }
}
