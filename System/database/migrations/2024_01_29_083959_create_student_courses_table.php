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
        Schema::create('student_courses', function (Blueprint $table) {
            $table->id();
            $table->string('term_id', 255);
            $table->string('student_id', 255);
            $table->string('block_section', 255)->nullable();
            $table->string('course_id', 255);
            $table->string('flowchart_id', 255)->nullable();
            $table->string('fee_schedule_id', 255)->nullable();
            $table->unsignedInteger('program_type_id');
            $table->unsignedInteger('grade_year_level_id');
            $table->unsignedInteger('enrollment_status_id');
            $table->unsignedInteger('academic_status_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_courses');
    }
};
