<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('tbl_course_categories', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('cate_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('course_id')->references('course_id')->on('tbl_courses')->onDelete('cascade');
            $table->foreign('cate_id')->references('cate_id')->on('tbl_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_course_categories');
    }
};
