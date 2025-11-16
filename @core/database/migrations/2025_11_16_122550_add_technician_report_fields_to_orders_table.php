<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTechnicianReportFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // تقرير الفني بالتفاصيل
            if (!Schema::hasColumn('orders', 'technician_report')) {
                $table->longText('technician_report')->nullable()->after('notes');
            }
            
            // صور الصيانة (JSON array)
            if (!Schema::hasColumn('orders', 'technician_images')) {
                $table->json('technician_images')->nullable()->after('technician_report');
            }
            
            // فيديوهات الصيانة (JSON array)
            if (!Schema::hasColumn('orders', 'technician_videos')) {
                $table->json('technician_videos')->nullable()->after('technician_images');
            }
            
            // تاريخ إرسال التقرير
            if (!Schema::hasColumn('orders', 'technician_report_submitted_at')) {
                $table->timestamp('technician_report_submitted_at')->nullable()->after('technician_videos');
            }
            
            // السعر المقترح من فريق الدعم/الإدمن
            if (!Schema::hasColumn('orders', 'admin_pricing')) {
                $table->decimal('admin_pricing', 10, 2)->nullable()->after('technician_report_submitted_at');
            }
            
            // ملاحظات الإدمن/فريق الدعم على التسعير
            if (!Schema::hasColumn('orders', 'admin_pricing_notes')) {
                $table->text('admin_pricing_notes')->nullable()->after('admin_pricing');
            }
            
            // تاريخ التسعير
            if (!Schema::hasColumn('orders', 'admin_pricing_at')) {
                $table->timestamp('admin_pricing_at')->nullable()->after('admin_pricing_notes');
            }
            
            // من قام بالتسعير
            if (!Schema::hasColumn('orders', 'admin_pricing_by')) {
                $table->unsignedBigInteger('admin_pricing_by')->nullable()->after('admin_pricing_at');
                $table->foreign('admin_pricing_by')->references('id')->on('admins')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['admin_pricing_by']);
            $table->dropColumn([
                'technician_report',
                'technician_images',
                'technician_videos',
                'technician_report_submitted_at',
                'admin_pricing',
                'admin_pricing_notes',
                'admin_pricing_at',
                'admin_pricing_by'
            ]);
        });
    }
}
