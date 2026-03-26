<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_block', function (Blueprint $table) {
            $table->foreignId('test_id')->constrained('tests')->onDelete('cascade');
            $table->foreignId('block_id')->constrained('blocks')->onDelete('cascade');
            $table->primary(['test_id', 'block_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_block');
    }
};
