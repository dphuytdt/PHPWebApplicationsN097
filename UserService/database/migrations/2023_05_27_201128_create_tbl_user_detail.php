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
        Schema::create('tbl_user_detail', function (Blueprint $table) {
            $table->id();
            //province_id
            $table->integer('province_id')->nullable();
            //district_id
            $table->integer('district_id')->nullable();
            //ward_id
            $table->integer('ward_id')->nullable();
            //address
            $table->string('address')->nullable();
            //phone
            $table->string('phone')->nullable();
            //gender
            $table->tinyInteger('gender');
            //birthday
            $table->date('birthday')->nullable();
            //avatar
            $table->string('avatar')->nullable();

            //relationship with user
            $table->integer('user_id')->unsigned();

            //foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user_detail');
    }
};
