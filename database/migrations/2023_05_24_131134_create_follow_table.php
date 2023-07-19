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
        Schema::create('follow', function (Blueprint $table) {
            $table->id('follow_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tutor_id');
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('tutor_id')->references('tutor_id')->on('tutors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow');
    }
};
