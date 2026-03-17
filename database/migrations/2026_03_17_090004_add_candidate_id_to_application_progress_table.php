<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('application_progress', function (Blueprint $table) {
            $table->foreignId('candidate_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('application_progress', function (Blueprint $table) {
            $table->dropColumn('candidate_id');
        });
    }
};