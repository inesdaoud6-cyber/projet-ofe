<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('photo_path')->nullable();
            $table->integer('current_level')->default(1); // 1, 2 ou 3
            $table->enum('status', ['pending', 'in_progress', 'validated', 'rejected'])->default('pending');
            $table->float('primary_score')->nullable();
            $table->float('secondary_score')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
