<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // تاريخ تأكيد التقرير من الأدمن
            if (!Schema::hasColumn('orders', 'technician_report_confirmed_at')) {
                $table->timestamp('technician_report_confirmed_at')->nullable()->after('technician_report_submitted_at');
            }
            
            // من قام بتأكيد التقرير (الأدمن)
            if (!Schema::hasColumn('orders', 'technician_report_confirmed_by')) {
                $table->unsignedBigInteger('technician_report_confirmed_by')->nullable()->after('technician_report_confirmed_at');
                $table->foreign('technician_report_confirmed_by')->references('id')->on('admins')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'technician_report_confirmed_by')) {
                $table->dropForeign(['technician_report_confirmed_by']);
            }
            if (Schema::hasColumn('orders', 'technician_report_confirmed_at')) {
                $table->dropColumn('technician_report_confirmed_at');
            }
            if (Schema::hasColumn('orders', 'technician_report_confirmed_by')) {
                $table->dropColumn('technician_report_confirmed_by');
            }
        });
    }
};
