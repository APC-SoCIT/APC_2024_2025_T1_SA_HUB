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
        Schema::create('student_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 255);
            $table->string('subject_offering_id', 255);
            $table->string('term_id', 255);
            $table->string('subject_code', 255);
            $table->unsignedInteger('enrollment_status_id');
            $table->dateTime('date_reference');
            $table->text('remarks')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->timestamp('enrolled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_schedules');
    }
};
