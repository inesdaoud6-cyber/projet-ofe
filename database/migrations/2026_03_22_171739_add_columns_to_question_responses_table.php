<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('question_responses', function (Blueprint $table) {
            $table->foreignId('response_id')->constrained('responses')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->foreignId('answer_id')->nullable()->constrained('answers')->onDelete('set null');
            $table->float('auto_score')->default(0);
            $table->float('manual_score')->default(0);
            $table->float('obtained_score')->default(0);
            $table->text('text_answer')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('question_responses', function (Blueprint $table) {
            $table->dropColumn(['response_id', 'question_id', 'answer_id', 'auto_score', 'manual_score', 'obtained_score', 'text_answer']);
        });
    }
};