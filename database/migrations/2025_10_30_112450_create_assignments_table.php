<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_assignments', function (Blueprint $table) {
            $table->id('assignment_id');
            $table->foreignId('course_id')->constrained('tbl_courses', 'course_id')->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('tbl_type_works', 'type_id')->cascadeOnDelete();
            $table->string('title');
            $table->dateTime('due_date')->nullable();
            $table->decimal('max_score', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_assignments');
    }
};
