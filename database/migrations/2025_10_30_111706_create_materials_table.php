<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_materials', function (Blueprint $table) {
            $table->id('material_id');
            $table->foreignId('course_id')->constrained('tbl_courses', 'course_id')->cascadeOnDelete();
            $table->string('file_type');
            $table->string('file_path');
            $table->timestamp('upload_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_materials');
    }
};
