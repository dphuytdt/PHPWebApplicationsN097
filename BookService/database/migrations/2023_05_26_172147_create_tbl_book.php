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
        Schema::create('tbl_book', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('author', 255);
            $table->string('category_id');
            $table->decimal('price', 8, 2);
            $table->longText('description')->nullable();
            $table->longText('cover_image')->nullable();
            $table->string('image_extension', 255)->nullable();
            $table->integer('content_type')->comment('1: text, 2: pdf, 3: video')->default(1);
            $table->longText('content');
            $table->integer('discount')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_vip_valid')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('tbl_book');
    }
};
