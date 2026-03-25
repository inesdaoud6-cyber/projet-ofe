<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('domain');
            $table->enum('contract_type', ['CDI', 'CDD', 'Stage', 'Freelance'])->default('CDI');
            $table->boolean('is_published')->default(false);
            $table->dateTime('deadline')->nullable();
            $table->timestamps();

            $table->index('is_published');
            $table->index('domain');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};