<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_services', function (Blueprint $table) {
            // العلاقة مع الطبيب
            $table->unsignedBigInteger('doctor_id');

            // العلاقة مع التخصص
            $table->unsignedBigInteger('specialty_id');

            // اسم الخدمة بالعربية والإنجليزية
            $table->string('name_ar');
            $table->string('name_en');

            // وصف الخدمة بالعربية والإنجليزية
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();

            // سعر الخدمة
            $table->decimal('price', 10, 2)->default(0);

            // مدة الخدمة بالدقائق
            $table->integer('duration')->default(30);

            // حالة الخدمة (نشطة/غير نشطة)
            $table->boolean('is_active')->default(true);

            // ترتيب العرض
            $table->integer('order')->default(0);

            // توقيتات الحذف الناعم
            $table->softDeletes();

            // توقيتات الإنشاء والتحديث
            $table->timestamps();

            // الفهارس
            $table->index('doctor_id');
            $table->index('specialty_id');
            $table->index('is_active');
            $table->index('order');
            $table->index(['doctor_id', 'specialty_id']);
            $table->index(['doctor_id', 'is_active']);

            // المفاتيح الخارجية
            $table->foreign('doctor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('specialty_id')
                ->references('id')
                ->on('specialties')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_services');
    }
}
