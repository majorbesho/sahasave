<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogSeoDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_seo_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->json('keyword_positions')->nullable(); // Track keyword rankings
            $table->json('backlinks')->nullable(); // Incoming links
            $table->json('internal_links')->nullable(); // Internal linking structure
            $table->json('external_links')->nullable(); // Outbound links
            $table->json('heading_structure')->nullable(); // H1, H2, H3 analysis
            $table->float('page_speed_score')->nullable();
            $table->float('mobile_friendliness_score')->nullable();
            $table->json('core_web_vitals')->nullable();
            $table->json('screenshot_data')->nullable(); // For visual changes tracking
            $table->timestamp('last_seo_audit')->nullable();
            $table->json('audit_results')->nullable();
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->unique('blog_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_seo_data');
    }
}
