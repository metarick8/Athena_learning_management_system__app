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
        Schema::create('rates', function (Blueprint $table) {
            $table->id('rate_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->double('rate');
            $table->text('opinion')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('course_id')->references('course_id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
