<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('application_progress', function (Blueprint $table) {
            $table->foreignId('offre_id')->nullable()->constrained('offres')->onDelete('set null');
            $table->string('status')->default('pending');
            $table->integer('current_level')->default(1);
            $table->float('main_score')->default(0);
            $table->float('secondary_score')->default(0);
            $table->boolean('apply_enabled')->default(false);
            $table->boolean('score_published')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('application_progress', function (Blueprint $table) {
            $table->dropColumn(['offre_id', 'status', 'current_level', 'main_score', 'secondary_score', 'apply_enabled', 'score_published']);
        });
    }
};