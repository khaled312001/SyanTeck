<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddMaintenanceFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // إضافة الحقول الجديدة أولاً (مع التحقق من وجودها)
        if (!Schema::hasColumn('orders', 'tracking_code')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('tracking_code')->unique()->nullable()->after('invoice');
            });
        }
        
        if (!Schema::hasColumn('orders', 'warranty_code')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('warranty_code')->unique()->nullable()->after('tracking_code');
            });
        }
        
        if (!Schema::hasColumn('orders', 'warranty_days')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->integer('warranty_days')->default(30)->after('warranty_code');
            });
        }
        
        if (!Schema::hasColumn('orders', 'has_warranty')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->boolean('has_warranty')->default(true)->after('warranty_days');
            });
        }
        
        if (!Schema::hasColumn('orders', 'assigned_by')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->integer('assigned_by')->nullable()->after('seller_id')->comment('ID of admin/support who assigned');
            });
        }
        
        if (!Schema::hasColumn('orders', 'region_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedBigInteger('region_id')->nullable()->after('area');
            });
        }
        
        if (!Schema::hasColumn('orders', 'notes')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->text('notes')->nullable()->after('order_note');
            });
        }
        
        if (!Schema::hasColumn('orders', 'urgency_level')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('urgency_level')->default('normal')->after('status')->comment('normal, urgent, emergency');
            });
        }
        
        if (!Schema::hasColumn('orders', 'assigned_at')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->timestamp('assigned_at')->nullable()->after('urgency_level');
            });
        }
        
        if (!Schema::hasColumn('orders', 'accepted_at')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->timestamp('accepted_at')->nullable()->after('assigned_at');
            });
        }
        
        if (!Schema::hasColumn('orders', 'en_route_at')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->timestamp('en_route_at')->nullable()->after('accepted_at');
            });
        }
        
        if (!Schema::hasColumn('orders', 'arrived_at')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->timestamp('arrived_at')->nullable()->after('en_route_at');
            });
        }
        
        if (!Schema::hasColumn('orders', 'started_at')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->timestamp('started_at')->nullable()->after('arrived_at');
            });
        }
        
        if (!Schema::hasColumn('orders', 'completed_at')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->timestamp('completed_at')->nullable()->after('started_at');
            });
        }
        
        // إضافة foreign key للمنطقة (مع التحقق من عدم وجوده)
        if (Schema::hasColumn('orders', 'region_id')) {
            // التحقق من وجود foreign key constraint
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = DATABASE() 
                AND TABLE_NAME = 'orders' 
                AND COLUMN_NAME = 'region_id' 
                AND REFERENCED_TABLE_NAME IS NOT NULL
            ");
            
            if (empty($foreignKeys)) {
                Schema::table('orders', function (Blueprint $table) {
                    $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['region_id']);
            $table->dropColumn([
                'tracking_code',
                'warranty_code',
                'warranty_days',
                'has_warranty',
                'assigned_by',
                'region_id',
                'notes',
                'urgency_level',
                'assigned_at',
                'accepted_at',
                'en_route_at',
                'arrived_at',
                'started_at',
                'completed_at'
            ]);
        });
    }
}

