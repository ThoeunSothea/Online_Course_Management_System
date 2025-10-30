<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_quiz_results', function (Blueprint $table) {
            $table->id('quiz_result_id');
            $table->foreignId('prof_id')->constrained('tbl_profiles', 'prof_id')->cascadeOnDelete();
            $table->foreignId('quiz_submission_id')->constrained('tbl_quiz_submissions', 'quiz_submission_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_quiz_results');
    }
};
