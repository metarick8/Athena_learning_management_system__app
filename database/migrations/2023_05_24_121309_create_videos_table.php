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
        Schema::create('videos', function (Blueprint $table) {
            $table->id('video_id');
            $table->unsignedBigInteger('module_id');
            $table->string('title');
            $table->time('duration');
            $table->string('path')->nullable();
            $table->timestamps();
            $table->foreign('module_id')->references('module_id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
