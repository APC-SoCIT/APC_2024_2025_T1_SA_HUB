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
        //
        Schema::create('user_tasks_timelog', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('task_id');
            $table->string('task_status');
            $table->timestamp('time_in')->nullable();
            $table->timestamp('time_out')->nullable();
            $table->integer('total_hours')->nullable(); 
            $table->string('is_Approve_in')->nullable(); // make this null
            $table->string('is_Approve_out')->nullable(); // make this null
            $table->string('feedback')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('user_tasks_timelog');
    }
};
