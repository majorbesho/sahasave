<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDuplicateMetaColumnsFromFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faqs', function (Blueprint $table) {
            // حذف الحقول المكررة من الجدول الرئيسي
            // لأنها موجودة في جدول الترجمات
            if (Schema::hasColumn('faqs', 'meta_title')) {
                $table->dropColumn('meta_title');
            }
            if (Schema::hasColumn('faqs', 'meta_description')) {
                $table->dropColumn('meta_description');
            }
            if (Schema::hasColumn('faqs', 'meta_keywords')) {
                $table->dropColumn('meta_keywords');
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
        Schema::table('faqs', function (Blueprint $table) {
            // إعادة الحقول في حالة التراجع
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
        });
    }
}
