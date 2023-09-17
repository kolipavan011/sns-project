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
        // user table
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        // files table
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('path');
            $table->string('type',20);
            $table->uuid('user_id');
            $table->uuid('folder_id');
            $table->json('detail')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        // posts table
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->string('title');
            $table->text('summary')->nullable();
            $table->text('body')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->string('featured_image')->nullable();
            $table->uuid('user_id')->index();
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['slug', 'user_id']);
        });

        // categorys table
        Schema::create('category', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->string('title');
            $table->text('summary')->nullable();
            $table->text('body')->nullable();
            $table->string('featured_image')->nullable();
            $table->uuid('user_id')->index();
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['slug', 'user_id']);
        });

        // tags table
        Schema::create('tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->string('title');
            $table->text('summary')->nullable();
            $table->text('body')->nullable();
            $table->string('featured_image')->nullable();
            $table->uuid('user_id')->index();
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['slug', 'user_id']);
        });

        // file manager table
        Schema::create('file_manager', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('folder_name');
            $table->string('folder_slug',5)->index();
            $table->string('folder_parent');
            $table->softDeletes();
            $table->timestamps();
        });

        // post relationship with category
        Schema::create('posts_tags', function (Blueprint $table) {
            $table->uuid('post_id');
            $table->uuid('tag_id');
            $table->unique(['post_id', 'tag_id']);
        });

        // post relationship with category
        Schema::create('posts_category', function (Blueprint $table) {
            $table->uuid('post_id');
            $table->uuid('category_id');
            $table->unique(['post_id', 'category_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('category');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('files');
        Schema::dropIfExists('file_manager');
    }
};
