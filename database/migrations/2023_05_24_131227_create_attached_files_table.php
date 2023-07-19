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
        Schema::create('attached_files', function (Blueprint $table) {
            $table->id('attached_file_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('video_id');
            $table->string('pic_path');
            $table->string('intro_path');
            $table->timestamps();
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->foreign('video_id')->references('video_id')->on('videos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attached_files');
    }
};
