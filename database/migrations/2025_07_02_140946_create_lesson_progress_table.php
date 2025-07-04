<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('lesson_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status', ['not_started', 'ongoing', 'completed'])->default('not_started');
            $table->timestamp('completed_at')->nullable();
            $table->unique(['user_id', 'lesson_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('lesson_progress');
    }
};
