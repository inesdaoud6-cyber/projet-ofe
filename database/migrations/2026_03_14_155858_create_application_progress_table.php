<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('application_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('offre_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('test_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['pending', 'in_progress', 'validated', 'rejected'])->default('pending');
            $table->integer('current_level')->default(1);
            $table->float('main_score')->default(0);
            $table->float('secondary_score')->default(0);
            $table->boolean('apply_enabled')->default(true);
            $table->boolean('score_published')->default(false);
            $table->timestamps();

            $table->index('candidate_id');
            $table->index('offre_id');
            $table->index('status');
            $table->index('current_level');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_progress');
    }
};