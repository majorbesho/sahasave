<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_specialties', function (Blueprint $table) {
            $table->id();

            // العلاقة مع الطبيب
            $table->unsignedBigInteger('doctor_id');

            // العلاقة مع التخصص
            $table->unsignedBigInteger('specialty_id');

            // هل هذا التخصص أساسي للطبيب؟
            $table->boolean('is_primary')->default(false);

            // سنوات الخبرة في هذا التخصص
            $table->integer('years_experience')->nullable();

            // توقيتات الإنشاء والتحديث
            $table->timestamps();

            // الفهارس
            $table->index('doctor_id');
            $table->index('specialty_id');
            $table->index('is_primary');
            $table->unique(['doctor_id', 'specialty_id']);

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
        Schema::dropIfExists('doctor_specialties');
    }
}
