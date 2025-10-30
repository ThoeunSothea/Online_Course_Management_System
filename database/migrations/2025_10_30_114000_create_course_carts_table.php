<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesExtraTables extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_course_carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->unsignedBigInteger('course_id');           
            $table->timestamps();

            // Foreign key
            $table->foreign('course_id')->references('course_id')->on('tbl_courses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_course_carts');
    }
}
