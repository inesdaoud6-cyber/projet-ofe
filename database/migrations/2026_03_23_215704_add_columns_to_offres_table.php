<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('domain')->nullable();
            $table->string('location')->nullable();
            $table->string('contract_type')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_published')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'domain', 'location', 'contract_type', 'deadline', 'is_published']);
        });
    }
};