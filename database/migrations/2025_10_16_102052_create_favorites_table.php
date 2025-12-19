<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('patient_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->comment('المريض');

            $table->foreignId('doctor_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->comment('الطبيب');

            // Additional Info (Optional)
            $table->string('note')->nullable()->comment('ملاحظة شخصية');
            $table->boolean('notify_availability')->default(true)->comment('إشعار عند التوفر');
            $table->timestamp('last_viewed_at')->nullable()->comment('آخر مشاهدة');
            $table->unsignedInteger('views_count')->default(0)->comment('عدد المشاهدات');

            // Timestamps
            $table->timestamps();

            // Indexes for Performance
            $table->unique(['patient_id', 'doctor_id'], 'unique_patient_doctor');
            $table->index('patient_id');
            $table->index('doctor_id');
            $table->index('created_at'); // للترتيب حسب الإضافة
            $table->index(['patient_id', 'created_at']); // Composite index
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
