<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('appointment_id')->nullable()
                ->constrained('appointments')
                ->nullOnDelete();

            $table->foreignId('recorded_by')->nullable()
                ->comment('Doctor/Nurse ID')
                ->constrained('users')
                ->nullOnDelete();

            // Vital Signs
            $table->unsignedSmallInteger('systolic')->nullable()->comment('ضغط الدم الانقباضي');
            $table->unsignedSmallInteger('diastolic')->nullable()->comment('ضغط الدم الانبساطي');
            $table->unsignedSmallInteger('heart_rate')->nullable()->comment('نبضات القلب');
            $table->decimal('temperature', 4, 1)->nullable()->comment('درجة الحرارة');
            $table->unsignedSmallInteger('respiratory_rate')->nullable()->comment('معدل التنفس');
            $table->unsignedSmallInteger('oxygen_saturation')->nullable()->comment('تشبع الأكسجين %');
            $table->decimal('blood_sugar', 5, 2)->nullable()->comment('سكر الدم');
            $table->decimal('weight', 5, 2)->nullable()->comment('الوزن');
            $table->decimal('height', 5, 2)->nullable()->comment('الطول');
            $table->decimal('bmi', 4, 2)->nullable()->comment('مؤشر كتلة الجسم');

            $table->text('notes')->nullable();
            $table->timestamp('recorded_at')->useCurrent();

            $table->timestamps();

            $table->index(['patient_id', 'recorded_at']);
            $table->index('appointment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vital_signs');
    }
}
