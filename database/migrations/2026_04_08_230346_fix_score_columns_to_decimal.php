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
    Schema::table('candidates', function (Blueprint $table) {
        $table->decimal('primary_score', 5, 2)->default(0)->change();
        $table->decimal('secondary_score', 5, 2)->default(0)->change();
    });

    Schema::table('application_progress', function (Blueprint $table) {
        $table->decimal('main_score', 5, 2)->default(0)->change();
        $table->decimal('secondary_score', 5, 2)->default(0)->change();
    });

    Schema::table('question_responses', function (Blueprint $table) {
        $table->decimal('auto_score', 5, 2)->default(0)->change();
        $table->decimal('manual_score', 5, 2)->default(0)->change();
        $table->decimal('obtained_score', 5, 2)->default(0)->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('decimal', function (Blueprint $table) {
            //
        });
    }
};
