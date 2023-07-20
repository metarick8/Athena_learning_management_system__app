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
        Schema::create('subscription_for_privates', function (Blueprint $table) {
            $table->id('subscription_for_private_id');
            $table->unsignedBigInteger('private_course_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('private_course_id')->references('private_course_id')->on('private_courses');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_for_privates');
    }
};
