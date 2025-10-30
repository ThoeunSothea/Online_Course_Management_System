<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_quiz_submissions', function (Blueprint $table) {
            $table->id('quiz_submission_id');
            $table->foreignId('quiz_id')->constrained('tbl_quizzes', 'quiz_id')->cascadeOnDelete();
            $table->foreignId('prof_id')->constrained('tbl_profiles', 'prof_id')->cascadeOnDelete();
            $table->string('file_path')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->float('score')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_quiz_submissions');
    }
};

