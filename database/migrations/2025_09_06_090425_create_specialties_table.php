<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();

            // Basic Info (Bilingual)
            $table->string('name_ar')->index();
            $table->string('name_en')->index();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();

            // Media
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('color', 7)->default('#3B82F6'); // Hex color

            // Status & Display
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_emergency_available')->default(false);
            $table->unsignedInteger('order')->default(0);

            // Statistics
            $table->unsignedInteger('doctors_count')->default(0)->index();
            $table->unsignedInteger('consultations_count')->default(0)->index();
            $table->unsignedInteger('children_count')->default(0);

            // Pricing Statistics
            $table->decimal('average_consultation_fee', 10, 2)->default(0);
            $table->decimal('min_consultation_fee', 10, 2)->default(0);
            $table->decimal('max_consultation_fee', 10, 2)->default(0);

            // Rating Statistics
            $table->decimal('average_rating', 3, 1)->default(0);
            $table->unsignedInteger('total_reviews')->default(0);

            // SEO (Bilingual)
            $table->string('slug_ar')->unique()->index();
            $table->string('slug_en')->unique()->index();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->json('keywords')->nullable(); // للبحث

            // Hierarchy
            $table->foreignId('parent_id')->nullable()
                ->constrained('specialties')
                ->nullOnDelete()
                ->index();
            $table->unsignedTinyInteger('level')->default(1)->index();

            // Additional Data
            $table->json('requirements')->nullable(); // متطلبات التخصص
            $table->json('skills')->nullable();       // المهارات المطلوبة

            // Timestamps & Soft Delete
            $table->softDeletes();
            $table->timestamps();

            // Composite Indexes
            $table->index(['is_active', 'is_featured', 'order']);
            $table->index(['parent_id', 'is_active', 'order']);
            $table->index(['doctors_count', 'average_rating']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('specialties');
    }
};
