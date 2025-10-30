<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_assignment_results', function (Blueprint $table) {
            $table->id('assignment_result_id');
            $table->foreignId('prof_id')->constrained('tbl_profiles', 'prof_id')->cascadeOnDelete();
            $table->foreignId('assign_submission_id')->constrained('tbl_assignment_submissions', 'assign_submission_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_assignment_results');
    }
};

