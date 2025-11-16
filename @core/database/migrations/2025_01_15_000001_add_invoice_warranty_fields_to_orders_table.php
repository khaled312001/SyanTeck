<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceWarrantyFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // حقول الفاتورة الإلكترونية
            if (!Schema::hasColumn('orders', 'invoice_pdf')) {
                $table->string('invoice_pdf')->nullable()->after('invoice')->comment('مسار ملف الفاتورة PDF');
            }
            
            if (!Schema::hasColumn('orders', 'invoice_number')) {
                $table->string('invoice_number')->unique()->nullable()->after('invoice_pdf')->comment('رقم الفاتورة');
            }
            
            if (!Schema::hasColumn('orders', 'invoice_date')) {
                $table->date('invoice_date')->nullable()->after('invoice_number')->comment('تاريخ إصدار الفاتورة');
            }
            
            if (!Schema::hasColumn('orders', 'invoice_issued_by')) {
                $table->integer('invoice_issued_by')->nullable()->after('invoice_date')->comment('ID من أصدر الفاتورة');
            }
            
            // حقول شهادة الضمان الإلكترونية
            if (!Schema::hasColumn('orders', 'warranty_pdf')) {
                $table->string('warranty_pdf')->nullable()->after('warranty_code')->comment('مسار ملف شهادة الضمان PDF');
            }
            
            if (!Schema::hasColumn('orders', 'warranty_issued_at')) {
                $table->timestamp('warranty_issued_at')->nullable()->after('warranty_pdf')->comment('تاريخ إصدار شهادة الضمان');
            }
            
            if (!Schema::hasColumn('orders', 'warranty_issued_by')) {
                $table->integer('warranty_issued_by')->nullable()->after('warranty_issued_at')->comment('ID من أصدر شهادة الضمان');
            }
            
            // حقل لصور العطل المتعددة (JSON)
            if (!Schema::hasColumn('orders', 'issue_images')) {
                $table->json('issue_images')->nullable()->after('issue_image')->comment('صور العطل المتعددة');
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
            $table->dropColumn([
                'invoice_pdf',
                'invoice_number',
                'invoice_date',
                'invoice_issued_by',
                'warranty_pdf',
                'warranty_issued_at',
                'warranty_issued_by',
                'issue_images'
            ]);
        });
    }
}

