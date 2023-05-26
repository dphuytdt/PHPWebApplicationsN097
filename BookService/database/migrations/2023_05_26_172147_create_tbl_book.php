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
            $table->string('title', 100);
            $table->integer('author_id');
            $table->integer('category_id');
            // $table->integer('publisher_id');
            $table->integer('quantity');
            $table->bigInteger('price');
            $table->string('description', 255);
            $table->string('image', 255);
            $table->text('content');
            $table->tinyInteger('is_free');
            $table->integer('status');
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
