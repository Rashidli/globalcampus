<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_logs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->string('event_type'); // create, update, delete, assign_program, etc.
            $table->string('loggable_type'); // App\Models\Program, App\Models\Education etc.
            $table->unsignedBigInteger('loggable_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
            $table->text('description');
            $table->timestamps();

            $table->index(['loggable_type', 'loggable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_logs');
    }
};
