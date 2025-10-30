<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_announcements', function (Blueprint $table) {
            $table->id('announcement_id');
            $table->foreignId('course_id')->constrained('tbl_courses', 'course_id')->cascadeOnDelete();
            $table->foreignId('prof_id')->constrained('tbl_profiles', 'prof_id')->cascadeOnDelete();
            $table->text('message');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_announcements');
    }
 };

