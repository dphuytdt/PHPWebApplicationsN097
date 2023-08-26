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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->nullable(true);
            $table->string('description', 255)->nullable(true);
            $table->text('content');
            $table->longText('image');
            $table->string('image_extension', 255);
            $table->boolean('is_active');
            $table->integer('view')->nullable(true);
            $table->integer('like')->nullable(true);
            $table->integer('dislike')->nullable(true);
            $table->integer('comment')->nullable(true);
            $table->integer('share')->nullable(true);
            $table->integer('type')->nullable(true);
            $table->integer('is_hot')->nullable(true);
            $table->string('creadted_by', 255)->nullable(true);
            $table->longText('tags')->nullable(true);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
