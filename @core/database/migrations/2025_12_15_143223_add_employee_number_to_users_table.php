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
        Schema::table('users', function (Blueprint $table) {
            // الرقم الوظيفي للفني
            if (!Schema::hasColumn('users', 'employee_number')) {
                $table->string('employee_number', 50)->unique()->nullable()->after('technician_code')->comment('الرقم الوظيفي للفني');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'employee_number')) {
                $table->dropUnique(['employee_number']);
                $table->dropColumn('employee_number');
            }
        });
    }
};
