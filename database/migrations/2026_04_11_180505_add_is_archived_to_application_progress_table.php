<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('application_progress', function (Blueprint $table) {
            $table->boolean('is_archived')->default(false)->after('score_published');
            $table->index('is_archived');
        });
    }

    public function down(): void
    {
        Schema::table('application_progress', function (Blueprint $table) {
            $table->dropColumn('is_archived');
        });
    }
};
