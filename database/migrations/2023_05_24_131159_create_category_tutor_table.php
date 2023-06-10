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
        Schema::create('category_tutor', function (Blueprint $table) {
            $table->id('category_tutor_id');
            $table->unsignedBigInteger('tutor_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('tutor_id')->references('tutor_id')->on('tutors');
            $table->foreign('category_id')->references('category_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_tutor');
    }
};
