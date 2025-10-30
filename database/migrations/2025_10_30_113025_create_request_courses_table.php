<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_request_courses', function (Blueprint $table) {
            $table->id('request_id');
            $table->foreignId('prof_id')->constrained('tbl_profiles', 'prof_id')->cascadeOnDelete();
            $table->foreignId('approval_id')->constrained('tbl_approvals', 'approval_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_request_courses');
    }
};

