<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();

            // الأسماء والوصف
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();

            // الصورة واللون
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->default('#3498db');

            // الحالة والإعدادات
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);

            // الإحصائيات
            $table->integer('doctors_count')->default(0);
            $table->integer('consultations_count')->default(0);

            // SEO
            $table->string('slug_ar')->unique()->nullable();
            $table->string('slug_en')->unique()->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('meta_description_en')->nullable();

            // التصنيف (للتخصصات الرئيسية والفرعية)
            $table->foreignId('parent_id')->nullable()->constrained('specialties')->onDelete('cascade');
            $table->integer('level')->default(1); // 1: رئيسي, 2: فرعي, 3: تخصص دقيق

            // بيانات إضافية
            $table->json('requirements')->nullable(); // متطلبات التخصص
            $table->json('skills')->nullable(); // المهارات المطلوبة

            $table->timestamps();
            $table->softDeletes();

            // الفهارس
            $table->index(['is_active', 'is_featured']);
            $table->index('parent_id');
            $table->index('order');
            $table->index('level');
            $table->index('slug_ar');
            $table->index('slug_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialties');
    }
}
