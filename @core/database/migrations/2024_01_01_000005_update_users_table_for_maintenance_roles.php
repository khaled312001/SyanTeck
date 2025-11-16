<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableForMaintenanceRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // إضافة حقول جديدة للفنيين
            $table->json('specializations')->nullable()->after('about')->comment('Array of service category IDs');
            $table->json('assigned_regions')->nullable()->after('specializations')->comment('Array of region IDs');
            $table->boolean('is_available')->default(true)->after('assigned_regions');
            $table->string('technician_code')->unique()->nullable()->after('is_available');
            $table->decimal('rating', 3, 2)->default(0)->after('technician_code');
            $table->integer('completed_orders_count')->default(0)->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'specializations',
                'assigned_regions',
                'is_available',
                'technician_code',
                'rating',
                'completed_orders_count'
            ]);
        });
    }
}

