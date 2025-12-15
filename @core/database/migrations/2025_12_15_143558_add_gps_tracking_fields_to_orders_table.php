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
            // موقع الفني الحالي (GPS)
            if (!Schema::hasColumn('orders', 'technician_latitude')) {
                $table->decimal('technician_latitude', 10, 8)->nullable()->after('completed_at')->comment('خط عرض موقع الفني');
            }
            if (!Schema::hasColumn('orders', 'technician_longitude')) {
                $table->decimal('technician_longitude', 11, 8)->nullable()->after('technician_latitude')->comment('خط طول موقع الفني');
            }
            if (!Schema::hasColumn('orders', 'technician_last_location_update')) {
                $table->timestamp('technician_last_location_update')->nullable()->after('technician_longitude')->comment('آخر تحديث لموقع الفني');
            }
            // حالة قبول/رفض الطلب من الفني
            if (!Schema::hasColumn('orders', 'technician_order_status')) {
                $table->string('technician_order_status', 20)->nullable()->after('technician_last_location_update')->comment('حالة الطلب من الفني: pending, accepted, rejected, en_route, arrived, started, completed');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'technician_latitude')) {
                $table->dropColumn('technician_latitude');
            }
            if (Schema::hasColumn('orders', 'technician_longitude')) {
                $table->dropColumn('technician_longitude');
            }
            if (Schema::hasColumn('orders', 'technician_last_location_update')) {
                $table->dropColumn('technician_last_location_update');
            }
            if (Schema::hasColumn('orders', 'technician_order_status')) {
                $table->dropColumn('technician_order_status');
            }
        });
    }
};
