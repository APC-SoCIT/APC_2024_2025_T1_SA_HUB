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
        Schema::create('offenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('type')->default('grade'); // Minor Offence, Major Offence
            $table->string('description')->nullable();
            $table->string('status')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offenses');
    }
};
