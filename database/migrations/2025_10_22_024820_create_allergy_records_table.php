<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergyRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergy_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->enum('type', [
                'food',           // طعام
                'drug',           // دواء
                'environmental',  // بيئية
                'insect',         // حشرات
                'latex',          // مطاط
                'other'           // أخرى
            ])->index();

            $table->string('allergen_name')->comment('اسم المادة المسببة للحساسية');
            $table->text('reaction')->nullable()->comment('رد الفعل');

            $table->enum('severity', ['mild', 'moderate', 'severe', 'life_threatening'])
                ->default('mild')
                ->comment('شدة الحساسية');

            $table->text('symptoms')->nullable()->comment('الأعراض');
            $table->date('first_reaction_date')->nullable();
            $table->date('last_reaction_date')->nullable();
            $table->text('treatment')->nullable()->comment('العلاج');

            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();

            $table->foreignId('diagnosed_by')->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Doctor who diagnosed');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['patient_id', 'is_active']);
            $table->index(['type', 'severity']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allergy_records');
    }
}
