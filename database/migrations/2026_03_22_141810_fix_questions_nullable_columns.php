<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->float('max_note')->default(0)->change();
            $table->float('second_ratio')->default(0)->change();
            $table->text('user_note')->nullable()->change();
            $table->text('note_rule')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->float('max_note')->nullable()->change();
        });
    }
};