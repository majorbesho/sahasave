<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');

            // معلومات الدواء
            $table->string('medication_name');
            $table->string('dosage')->comment('الجرعة');
            $table->string('frequency')->comment('التكرار');
            $table->string('duration')->comment('المدة');
            $table->text('instructions')->nullable()->comment('تعليمات الاستخدام');

            // الكميات
            $table->integer('quantity')->default(1);
            $table->integer('refills')->default(0)->comment('عدد المرات التي يمكن إعادة صرفها');

            // الفترات
            $table->date('start_date');
            $table->date('end_date')->nullable();

            // الحالة
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            $table->text('pharmacy_notes')->nullable();

            $table->timestamps();

            $table->index(['patient_id', 'status']);
            $table->index(['doctor_id', 'created_at']);
            $table->index('medical_record_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}
