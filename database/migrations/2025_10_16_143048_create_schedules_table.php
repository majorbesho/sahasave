<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            // المفاتيح الخارجية
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medical_center_id')->constrained()->onDelete('cascade');

            // يوم الأسبوع (0: الأحد, 1: الإثنين, ..., 6: السبت)
            $table->integer('day_of_week')->comment('0: Sunday, 1: Monday, ..., 6: Saturday');

            // وقت البدء والنهاية
            $table->time('start_time');
            $table->time('end_time');

            // نوع الجلسة
            $table->enum('session_type', ['consultation', 'follow_up', 'emergency'])->default('consultation');

            // مدة الجلسة بالدقائق
            $table->integer('session_duration')->default(30);

            // الحد الأقصى للجلسات في اليوم
            $table->integer('max_sessions')->default(20);

            // الحالة
            $table->boolean('is_active')->default(true);

            // التواريخ
            $table->date('effective_from')->nullable();
            $table->date('effective_until')->nullable();

            $table->timestamps();

            // فهارس
            $table->index(['doctor_id', 'medical_center_id', 'day_of_week']);
            $table->index(['doctor_id', 'is_active']);
            $table->unique(['doctor_id', 'medical_center_id', 'day_of_week', 'start_time'], 'unique_schedule_slot');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
