<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lab_center_id')->constrained('medical_centers')->onDelete('cascade');

            // معلومات الفحص
            $table->string('test_name');
            $table->string('test_type');
            $table->text('instructions')->nullable();
            $table->json('required_samples')->nullable()->comment('العينات المطلوبة');

            // الأولوية
            $table->enum('urgency_level', ['low', 'medium', 'high', 'critical'])->default('medium');

            // النتائج
            $table->json('results')->nullable()->comment('نتائج الفحص');
            $table->timestamp('result_date')->nullable();

            // الحالة
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['patient_id', 'status']);
            $table->index(['doctor_id', 'created_at']);
            $table->index(['lab_center_id', 'status']);
            $table->index('urgency_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_orders');
    }
}
