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
        Schema::create('theses', function (Blueprint $table) {
            $table->id('id');
            $table->string('title', 255);
            $table->unsignedBigInteger('student_id');
            $table->string('program', 255);
            $table->string('supervisor', 100);
            $table->text('abstract');
            $table->date('submission_date');
            $table->date('defense_date');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
