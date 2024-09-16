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
        Schema::create('subject_offerings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('school_level_id');
            $table->string('term_id', 255);
            $table->string('subject_id', 255);
            $table->string('subject_code', 255);
            $table->string('section', 255);
            $table->string('type', 255); // e.g., lecture, lab
            $table->string('day_id', 255);
            $table->string('room_type', 255);
            $table->string('room_id', 255);
            $table->boolean('remedial')->default(false);
            $table->string('campus_id', 255);
            $table->string('reference_id', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_offerings');
    }
};
