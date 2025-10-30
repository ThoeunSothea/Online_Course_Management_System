<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_quizzes', function (Blueprint $table) {
            $table->id('quiz_id');
            $table->foreignId('course_id')->constrained('tbl_courses', 'course_id')->cascadeOnDelete();
            $table->string('title');
            $table->text('question')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_quizzes');
    }
};

