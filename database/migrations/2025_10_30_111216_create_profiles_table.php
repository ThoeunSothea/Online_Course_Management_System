<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_profiles', function (Blueprint $table) {
            $table->id('prof_id');
            $table->foreignId('user_id')->constrained('tbl_users', 'user_id')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('headline', 150)->nullable();
            $table->text('biography')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('website')->nullable();
            $table->string('telegram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('tiktok')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_profiles');
    }
};
