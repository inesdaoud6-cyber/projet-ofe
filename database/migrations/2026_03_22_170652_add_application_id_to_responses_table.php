<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('responses', function (Blueprint $table) {
            $table->foreignId('application_id')->constrained('application_progress')->onDelete('cascade');
            $table->integer('level')->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('responses', function (Blueprint $table) {
            $table->dropColumn(['application_id', 'level']);
        });
    }
};