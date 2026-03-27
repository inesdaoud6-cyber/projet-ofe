<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            
            $table->dropForeign(['offre_id']);
            $table->dropColumn('offre_id');
        });
    }

    public function down(): void
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->foreignId('offre_id')->nullable()->constrained('offres')->onDelete('set null');
        });
    }
};
