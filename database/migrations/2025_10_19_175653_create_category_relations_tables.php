<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryRelationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // جدول علاقة الأطباء مع الـ Categories
        Schema::create('category_doctor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['category_id', 'doctor_id']);
        });

        // جدول علاقة المستشفيات مع الـ Categories
        Schema::create('category_medical_center', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('medical_center_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['category_id', 'medical_center_id']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_medical_center');
        Schema::dropIfExists('category_doctor');
    }
}
