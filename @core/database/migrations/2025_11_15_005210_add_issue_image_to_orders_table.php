<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIssueImageToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('orders', 'issue_image')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('issue_image')->nullable()->after('order_note')->comment('صورة العطل أو المشكلة');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('orders', 'issue_image')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('issue_image');
            });
        }
    }
}
