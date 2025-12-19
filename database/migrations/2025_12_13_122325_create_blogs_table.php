<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->enum('visibility', ['public', 'private', 'members_only'])->default('public');
            $table->enum('content_type', ['article', 'news', 'guide', 'research', 'tips']);
            $table->string('reading_time')->nullable(); // e.g., "5 min"
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('shares')->default(0);
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->json('seo_data')->nullable(); // For SEO metadata
            $table->json('tags')->nullable(); // JSON array of tags
            $table->json('related_blogs')->nullable(); // JSON array of related blog IDs
            $table->json('structured_data')->nullable(); // For rich snippets
            $table->boolean('featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_for')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('set null');
            $table->index(['status', 'published_at']);
            $table->index(['category_id', 'featured']);




   

            // Fulltext index support depends on DB engine, usually supported in modern MySQL/MariaDB
            // Use raw statement or ensure engine supports it. 
            // $table->fullText(['title', 'content', 'excerpt']); // Laravel method
        });

        // Add Fulltext index using raw SQL if necessary or separate migration for compatibility, 
        // but Laravel 9/10 has fullText(). Checking if we can use it directly or raw.
        // Assuming Laravel 9+ based on usage.
        try {
            DB::statement('ALTER TABLE blogs ADD FULLTEXT fulltext_index (title, content, excerpt)');
        } catch (\Exception $e) {
            // Log or ignore if not supported (e.g. SQLite in tests)
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
