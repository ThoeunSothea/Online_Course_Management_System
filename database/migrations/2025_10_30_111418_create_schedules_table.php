<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tbl_schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->string('schedule_time');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tbl_schedules');
    }
};
