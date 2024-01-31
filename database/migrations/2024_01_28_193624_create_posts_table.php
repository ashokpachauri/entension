<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('catagory_id');
            $table->string('title');
            $table->string('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_image')->nullable();
            $table->string('snippet_image')->nullable();
            $table->string('featured_image')->nullable();
            $table->longText('content');
            $table->longText('snippet_content');
            $table->string('tags')->nullable();
            $table->string('note')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
