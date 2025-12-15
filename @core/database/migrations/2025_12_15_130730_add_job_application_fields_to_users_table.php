<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('job_type')->nullable()->after('user_type')->comment('نوع الوظيفة المراد التقديم عليها');
            $table->text('experience')->nullable()->after('job_type')->comment('الخبرة والمهارات');
            $table->string('resume_file')->nullable()->after('experience')->comment('ملف السيرة الذاتية');
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
            $table->dropColumn(['job_type', 'experience', 'resume_file']);
        });
    }
};
