<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrivateClinicFieldsToSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            // إضافة الحقول الجديدة للعيادات الخاصة
            $table->string('clinic_name')->nullable();
            $table->text('clinic_address')->nullable();
            $table->string('clinic_phone')->nullable();

            // إضافة الحقول المطلوبة للـ form
            $table->enum('appointment_type', ['clinic', 'virtual', 'home'])->default('clinic');
            $table->decimal('consultation_fee', 10, 2)->default(0);
            $table->boolean('is_recurring')->default(false);

            // تعديل بعض الحروف لجعلها nullable
            $table->integer('max_sessions')->default(10)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn([
                'clinic_name',
                'clinic_address',
                'clinic_phone',
                'appointment_type',
                'consultation_fee',
                'is_recurring'
            ]);
        });
    }
}
