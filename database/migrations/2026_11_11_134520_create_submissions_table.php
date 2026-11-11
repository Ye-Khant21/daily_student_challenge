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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->constrained('challenges');
            $table->foreignId('user_id')->constrained('users');
            $table->text('answer');
            $table->unsignedInteger('points_awarded')->nullable();
            $table->timestamps();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('feedback')->nullable();
            $table->unique(['challenge_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
