<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('type', ['clinic', 'medical_center', 'hospital', 'lab']);

            // معلومات الاتصال
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('website')->nullable();

            // العنوان
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country')->default('SA');
            $table->string('postal_code')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // المعلومات الإضافية
            $table->text('description')->nullable();
            $table->json('services')->nullable()->comment('الخدمات المقدمة');
            $table->json('facilities')->nullable()->comment('المرافق المتاحة');
            $table->json('insurance_providers')->nullable()->comment('شركات التأمين المقبولة');
            $table->json('working_hours')->nullable()->comment('ساعات العمل');

            // الوسوم والتصنيفات
            $table->json('specialties')->nullable()->comment('التخصصات المتاحة');

            // الإحصاءات
            $table->integer('doctor_count')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->integer('rating_count')->default(0);

            // الحالة
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['type', 'status']);
            $table->index('city');
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_centers');
    }
}
