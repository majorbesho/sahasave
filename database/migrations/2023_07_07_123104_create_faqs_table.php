<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    public function up()
    {
        // جدول التصنيفات (يجب أن يُنشأ أولاً)
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // جدول ترجمات التصنيفات
        Schema::create('faq_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_category_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unique(['faq_category_id', 'locale']);
        });

        // جدول للـ Tags (الكلمات المفتاحية)
        Schema::create('faq_tags', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('faq_tag_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_tag_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['faq_tag_id', 'locale']);
        });

        // جدول FAQs الرئيسي
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('photo')->nullable();
            $table->enum('status', ['active', 'inactive', 'draft'])->default('draft');

            // SEO Fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_image')->nullable();

            // Sorting and Organization
            $table->integer('sort_order')->default(0);
            $table->foreignId('category_id')->nullable()->constrained('faq_categories')->onDelete('set null');
            $table->json('related_faqs')->nullable();

            // Statistics
            $table->integer('views_count')->default(0);
            $table->integer('helpful_yes')->default(0);
            $table->integer('helpful_no')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['status', 'sort_order']);
            $table->index('category_id');
            $table->index('views_count');
        });

        // جدول الترجمات
        Schema::create('faq_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index(); // ar, en, etc.

            // المحتوى المتعدد اللغات
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('question');
            $table->text('answer');

            // SEO باللغة المحددة
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->unique(['faq_id', 'locale']);
        });

        // جدول العلاقة بين FAQs و Tags
        Schema::create('faq_faq_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faq_id')->constrained()->onDelete('cascade');
            $table->foreignId('faq_tag_id')->constrained()->onDelete('cascade');
            $table->unique(['faq_id', 'faq_tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('faq_faq_tag');
        Schema::dropIfExists('faq_tag_translations');
        Schema::dropIfExists('faq_tags');
        Schema::dropIfExists('faq_category_translations');
        Schema::dropIfExists('faq_categories');
        Schema::dropIfExists('faq_translations');
        Schema::dropIfExists('faqs');
    }
}
