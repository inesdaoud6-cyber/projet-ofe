<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('eligibility_threshold')->default(0);
            $table->float('talent_threshold')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->dropColumn(['name', 'description', 'eligibility_threshold', 'talent_threshold']);
        });
    }
};