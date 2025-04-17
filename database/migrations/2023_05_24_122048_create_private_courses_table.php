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
        Schema::create('private_courses', function (Blueprint $table) {
            $table->id('private_course_id');
            $table->unsignedBigInteger('tutor_id');
            $table->string('title');
            $table->integer('price');
            $table->time('appointment');
            $table->text('description');
            $table->boolean('finished')->default(false);
            $table->timestamps();
            $table->foreign('tutor_id')->references('tutor_id')->on('tutors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_courses');
    }
};
