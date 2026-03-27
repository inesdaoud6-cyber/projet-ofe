<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('question_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained('blocks')->onDelete('cascade');
            $table->string('name');
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->index('block_id');
        });

        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->nullable()->constrained('blocks')->onDelete('cascade');
            $table->foreignId('group_id')->nullable()->constrained('question_groups')->onDelete('cascade');
            $table->text('question_fr');
            $table->text('question_en')->nullable();
            $table->text('question_ar')->nullable();
            $table->enum('component', ['radio', 'list', 'text', 'date', 'photo']);
            $table->integer('level')->default(1);
            $table->boolean('obligatory')->default(false);
            $table->boolean('scorable')->default(true);
            $table->boolean('auto_evaluation')->default(false);
            $table->enum('classification', ['primary', 'secondary'])->default('primary');
            $table->float('max_note')->default(0);
            $table->float('second_ratio')->default(0);
            $table->text('user_note')->nullable();
            $table->text('note_rule')->nullable();
            $table->json('possible_answers')->nullable();
            $table->timestamps();
            $table->index('level');
            $table->index(['block_id', 'group_id']);
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->string('text');
            $table->boolean('is_correct')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->index('question_id');
            $table->index('is_correct');
        });

        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('eligibility_threshold')->default(50);
            $table->float('talent_threshold')->default(80);
            $table->timestamps();
            $table->index('name');
        });

        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('domain')->nullable();
            $table->string('location')->nullable();
            $table->string('contract_type')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_published')->default(false);
            $table->foreignId('test_id')->nullable()->constrained('tests')->onDelete('set null');
            $table->timestamps();
            $table->index('is_published');
            $table->index('domain');
        });

        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('cv_path')->nullable();
            $table->float('primary_score')->default(0);
            $table->float('secondary_score')->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('score_visibility')->default(false);
            $table->timestamps();
            $table->index('user_id');
            $table->index('status');
        });

        Schema::create('application_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates')->onDelete('cascade');
            $table->foreignId('offre_id')->nullable()->constrained('offres')->onDelete('set null');
            $table->foreignId('test_id')->nullable()->constrained('tests')->onDelete('set null');
            $table->enum('status', ['pending', 'in_progress', 'validated', 'rejected'])->default('pending');
            $table->integer('current_level')->default(1);
            $table->float('main_score')->default(0);
            $table->float('secondary_score')->default(0);
            $table->boolean('apply_enabled')->default(false);
            $table->boolean('score_published')->default(false);
            $table->timestamps();
            $table->index('candidate_id');
            $table->index('offre_id');
            $table->index('status');
        });

        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('application_progress')->onDelete('cascade');
            $table->integer('level')->default(1);
            $table->timestamps();
            $table->index(['application_id', 'level']);
        });

        Schema::create('question_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('response_id')->constrained('responses')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->foreignId('answer_id')->nullable()->constrained('answers')->onDelete('set null');
            $table->float('auto_score')->default(0);
            $table->float('manual_score')->default(0);
            $table->float('obtained_score')->default(0);
            $table->text('text_answer')->nullable();
            $table->timestamps();
            $table->index(['response_id', 'question_id']);
        });

        Schema::create('response_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_response_id')->constrained('question_responses')->onDelete('cascade');
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('note');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('response_notes');
        Schema::dropIfExists('question_responses');
        Schema::dropIfExists('responses');
        Schema::dropIfExists('application_progress');
        Schema::dropIfExists('candidates');
        Schema::dropIfExists('offres');
        Schema::dropIfExists('tests');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('levels');
        Schema::dropIfExists('question_groups');
        Schema::dropIfExists('blocks');
    }
};