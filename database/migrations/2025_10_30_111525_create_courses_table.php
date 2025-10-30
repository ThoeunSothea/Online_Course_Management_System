<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->foreignId('cate_id')->constrained('tbl_categories', 'cate_id')->cascadeOnDelete();
            $table->foreignId('schedule_id')->nullable()->constrained('tbl_schedules', 'schedule_id')->nullOnDelete();
            $table->foreignId('status_id')->nullable()->constrained('tbl_statuses', 'status_id')->nullOnDelete();
            $table->string('course_title');
            $table->text('description')->nullable();
            $table->timestamp('approve_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_courses');
    }
};

