<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->string('insurance_name');
            $table->string('insurance_company')->nullable();
            $table->string('policy_number')->nullable();
            $table->date('coverage_start_date')->nullable();
            $table->date('coverage_end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('coverage_details')->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->string('insurance_logo')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('website_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('doctor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Indexes
            $table->index(['doctor_id', 'is_active']);
            $table->index('sort_order');
            $table->index('insurance_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_insurances');
    }
}
