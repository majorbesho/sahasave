<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medical_center_id')->nullable()->constrained('medical_centers')->onDelete('cascade');
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->onDelete('set null');

            // التقييم
            $table->integer('rating')->comment('التقييم من 1-5');
            $table->text('review')->nullable();
            $table->json('aspects_ratings')->nullable()->comment('التقييم حسب الجوانب');

            // الحالة
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_visible')->default(true);

            $table->timestamps();

            $table->unique(['patient_id', 'appointment_id']);
            $table->index(['doctor_id', 'rating']);
            $table->index(['medical_center_id', 'rating']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
