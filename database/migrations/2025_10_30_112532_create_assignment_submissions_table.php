<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_assignment_submissions', function (Blueprint $table) {
            $table->id('assign_submission_id');
            $table->foreignId('assignment_id')->constrained('tbl_assignments', 'assignment_id')->cascadeOnDelete();
            $table->foreignId('prof_id')->constrained('tbl_profiles', 'prof_id')->cascadeOnDelete();
            $table->string('file_path')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->float('score')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_assignment_submissions');
    }
};
