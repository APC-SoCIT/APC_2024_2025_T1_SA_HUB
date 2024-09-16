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
        Schema::create('subject_offering_details', function (Blueprint $table) {
            $table->id();
            $table->string('subject_offering_id', 255);
            $table->json('time_constraints')->nullable(); 
            $table->json('instructors')->nullable(); 
            $table->json('prerequisites')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_offering_details');
    }
};
